<?php
/**
 * Service-page body checks.
 *
 * Option A ("Open Measure") plus one pull statement per page. Guards the two
 * traps: the standfirst must never repeat the hero subheading, and the
 * treatment must stay scoped to service pages.
 *
 * Run:  php tools/check-body-style.php
 */
$THEME = __DIR__ . '/../wp-content/themes/jce-tree-service';
$css   = preg_replace("#/\*.*?\*/#s", "", file_get_contents("$THEME/style.css")); // strip comments: they sit inside the selector capture otherwise
$fail  = 0;
function bad($m){ echo "FAIL: $m\n"; $GLOBALS['fail']++; }

// Helper: grab the declarations of the first rule whose selector matches exactly.
function decls($css, $sel) {
    preg_match_all('/([^{}]*)\{([^}]*)\}/', $css, $all, PREG_SET_ORDER);
    foreach ($all as $b) {
        foreach (explode(',', $b[1]) as $s) if (trim($s) === $sel) return $b[2];
    }
    return null;
}

// --- Option A applied ---
$a = decls($css, '.entry-content--service');
$a === null and bad('.entry-content--service rule missing');
if ($a) {
    str_contains($a, '1.78') or bad('line-height 1.78 (Option A) not applied');
    str_contains($a, '1.06rem') or bad('body size 1.06rem not applied');
}
$sf = decls($css, '.entry-content--service > p:first-child');
$sf === null and bad('standfirst rule missing');
if ($sf) {
    str_contains($sf, '1.3rem') or bad('standfirst is not 1.3rem');
    str_contains($sf, 'var(--ink)') or bad('standfirst does not use the ink token');
}
decls($css, '.entry-content--service > p:first-child::before') === null and bad('green rule above standfirst missing');

// --- B's pull statement, both class hooks ---
foreach (['.entry-content--service .is-style-jce-pull', '.entry-content--service .pull'] as $sel) {
    $d = decls($css, $sel);
    $d === null and bad("pull hook $sel missing");
    if ($d) {
        str_contains($d, 'var(--font-display)') or bad("$sel not set in the display face");
        str_contains($d, 'var(--green)') or bad("$sel has no green rule");
    }
}

// --- the trap: the standfirst must never also take the pull treatment ---
decls($css, '.entry-content--service > p:first-child.is-style-jce-pull::before') === null
    and bad('no guard against standfirst + pull stacking on one paragraph');

// --- scoping: blog posts and other templates must be untouched ---
$single = file_get_contents("$THEME/single.php");
str_contains($single, 'entry-content--service') and bad('blog posts picked up the service body style');
$svc = file_get_contents("$THEME/single-service.php");
str_contains($svc, 'entry-content entry-content--service') or bad('service template does not apply the modifier');

// --- the duplication trap: the hero no longer prints a standfirst on this
//     template (the body's own first paragraph is the standfirst instead),
//     so the excerpt should not appear here at all. If it reappears, it must
//     not be passed to both the hero and the body. ---
preg_match_all('/get_the_excerpt\(\)/', $svc, $ex);
count($ex[0]) <= 1 or bad('excerpt used '.count($ex[0]).' times in single-service.php - it must never render in both the hero and the body');

// --- block style registered so an editor can pick it ---
$setup = file_get_contents("$THEME/inc/theme-setup.php");
str_contains($setup, "register_block_style") or bad('Pull Statement block style not registered');
str_contains($setup, "'name'  => 'jce-pull'") or bad('block style name must match the CSS hook is-style-jce-pull');

echo $fail ? "\n$fail failures\n" : "body treatment: Option A applied, pull statement wired, scoping + duplication guards OK\n";
exit($fail ? 1 : 0);
