<?php
/**
 * List-marker checks.
 *
 * The reset only strips markers from lists that HAVE a class, so a component
 * list whose class sits on its wrapper keeps the browser's numbers and
 * bullets. That is what put "1. 2. 3." in front of the old breadcrumbs.
 * Prose lists must keep their markers.
 *
 * Run:  php tools/check-css-lists.php
 */
// Assert every unclassed component list has its markers stripped.
$css = file_get_contents(__DIR__ . '/../wp-content/themes/jce-tree-service/style.css');
$fail = 0;
foreach (['.primary-nav ul', '.site-footer ul'] as $sel) {
    // Find a rule block whose selector list contains $sel and which sets list-style:none.
    $ok = preg_match('/(^|\})([^{}]*' . preg_quote($sel, '/') . '[^{}]*)\{([^}]*)\}/m', $css, $m)
          && str_contains(str_replace(' ', '', $m[3]), 'list-style:none');
    if (!$ok) { echo "FAIL: $sel does not strip list markers\n"; $fail++; }
}
// Prose lists must KEEP their markers.
foreach ([['.entry-content ul','disc'], ['.entry-content ol','decimal']] as [$sel,$want]) {
    // Check EVERY block whose selector mentions $sel, not just the first —
    // .entry-content ul/ol appear in a shared padding rule before the
    // list-style ones.
    preg_match_all('/([^{}]*)\{([^}]*)\}/', $css, $all, PREG_SET_ORDER);
    $ok = false;
    foreach ($all as $blk) {
        if (str_contains($blk[1], $sel) && str_contains(str_replace(' ','',$blk[2]), 'list-style:'.$want)) { $ok = true; break; }
    }
    if (!$ok) { echo "FAIL: $sel no longer sets list-style: $want\n"; $fail++; }
}
// The global reset must not have been widened onto bare lists.
if (preg_match('/^\s*ul,\s*ol\s*\{[^}]*list-style:\s*none/m', $css)) {
    echo "FAIL: reset widened to all lists - landing-page prose would lose markers\n"; $fail++;
}
// Breadcrumbs were removed entirely — no orphan styles left behind.
if (str_contains($css, '.breadcrumbs')) { echo "FAIL: orphan .breadcrumbs CSS remains\n"; $fail++; }
echo $fail ? "$fail list failures\n" : "list markers: nav + footer stripped, prose preserved, no breadcrumb residue\n";
exit($fail ? 1 : 0);
