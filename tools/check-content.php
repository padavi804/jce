<?php
/**
 * Content + data checks for the JCE theme.
 *
 * Validates the copy and field data in inc/demo-content.php without needing a
 * WordPress install: that the approved services are complete and correctly
 * switched off where they have no approved copy, that every pipe-separated row
 * has all its parts, and that slugs line up with the icon and photo maps.
 *
 * Run:  php tools/check-content.php
 *
 * Lives outside wp-content/themes/ so it is never deployed with the theme.
 */

$THEME = __DIR__ . '/../wp-content/themes/jce-tree-service';

define( 'ABSPATH', 1 );
define( 'JCE_THEME_VERSION', 'test' );

// Minimal WordPress surface — enough to load the data and parsing layers.
function __( $s, $d = null ) { return $s; }
function _e( $s, $d = null ) { echo $s; }
function esc_html( $s ) { return $s; }
function esc_attr( $s ) { return $s; }
function add_action() {}
function add_filter() {}
function sanitize_text_field( $s ) { return trim( $s ); }
function wp_unslash( $s ) { return $s; }
function sanitize_title( $s ) { return strtolower( preg_replace( '/[^a-z0-9]+/i', '-', $s ) ); }
function wp_specialchars_decode( $s ) { return html_entity_decode( $s ); }
function get_post_meta() { return ''; }
function get_the_ID() { return 1; }
function get_theme_mod( $k, $d = '' ) { return $d; }
function esc_url_raw( $s ) { return $s; }

require "$THEME/inc/fields.php";
require "$THEME/inc/customizer.php";
require "$THEME/inc/demo-content.php";

$fail = 0;
function check( $cond, $msg ) {
	global $fail;
	if ( ! $cond ) { echo "FAIL: $msg\n"; $fail++; }
}

/* ---------- parsing ---------- */
check( jce_lines( "a\n\n b \nc" ) === array( 'a', 'b', 'c' ), 'jce_lines trims and drops blanks' );
check( jce_rows( "x|y\nz", 2 ) === array( array( 'x', 'y' ), array( 'z', '' ) ), 'jce_rows pads missing halves' );
check( jce_rows( 'Label|Copy with | inside', 2 ) === array( array( 'Label', 'Copy with | inside' ) ), 'jce_rows respects the column limit' );
check( jce_rows( '2001|Title|Body', 3 ) === array( array( '2001', 'Title', 'Body' ) ), 'jce_rows 3-column' );
check( jce_sanitize_lines( "a\nb\n" ) === "a\nb", 'sanitize preserves newlines' );

/* ---------- the off switch ---------- */
foreach ( array( '-', ' - ', 'none', 'NONE', 'hide', 'off' ) as $v ) {
	check( jce_field_is_off( $v ), "'$v' switches a section off" );
}
foreach ( array( '', 'a', '-a', 'dash - inside' ) as $v ) {
	check( ! jce_field_is_off( $v ), "'$v' does NOT switch a section off" );
}

/* ---------- sentence joiner ---------- */
check( jce_list_sentence( array( 'A' ) ) === 'A', 'one item' );
check( jce_list_sentence( array( 'A', 'B' ) ) === 'A and B', 'two items, no comma' );
check( jce_list_sentence( array( 'A', 'B', 'C' ) ) === 'A, B, and C', 'three items, Oxford comma' );

/* ---------- shared process steps ---------- */
$shared = jce_process_steps();
check( count( $shared ) === 5, 'five shared process steps' );
foreach ( $shared as $r ) {
	check( $r[0] !== '' && $r[1] !== '', 'shared step complete: ' . substr( $r[0], 0, 30 ) );
}
check( jce_default_process_heading() === 'How the JCE team works with you to get it done.', 'interior heading is the approved one' );
check( jce_default_process_heading_home() === 'The Personal Estimate', 'homepage keeps the brief pillar name' );

$home = file_get_contents( "$THEME/front-page.php" );
check( str_contains( $home, 'process_heading_home' ), 'front-page passes the homepage heading' );
check( ! str_contains( $home, "'rows'" ), 'front-page does NOT carry its own copy of the steps' );

/* ---------- services ---------- */
$svc    = jce_demo_services();
$slugs  = array_column( $svc, 'slug' );
$byslug = array();
foreach ( $svc as $s ) { $byslug[ $s['slug'] ] = $s; }

check( count( $svc ) === 9, 'nine services' );
check( count( array_unique( $slugs ) ) === 9, 'service slugs unique' );

foreach ( $svc as $s ) {
	check( ! isset( $s['meta']['_jce_service_steps'] ), "{$s['slug']} inherits the shared steps rather than copying them" );
	// A protected entry holds no copy on purpose — its text lives in WordPress.
	if ( empty( $s['protect'] ) ) {
		check( ! empty( $s['excerpt'] ), "{$s['slug']} has an excerpt" );
	}
}

// Icons: every service must resolve one, and it must be defined.
$iconsrc = file_get_contents( "$THEME/inc/icons.php" );
preg_match( '/function jce_service_icon_map.*?return array\((.*?)\);/s', $iconsrc, $im );
preg_match_all( "/'([a-z-]+)'\s*=>\s*'([a-z-]+)'/", $im[1], $pairs, PREG_SET_ORDER );
$iconmap = array();
foreach ( $pairs as $pr ) { $iconmap[ $pr[1] ] = $pr[2]; }
foreach ( $slugs as $sl ) {
	check( isset( $iconmap[ $sl ] ), "service '$sl' has an icon mapping" );
}

// Photos: a gap degrades to the branded placeholder by design, so report only.
$missing = array();
foreach ( $slugs as $sl ) {
	if ( ! file_exists( "$THEME/assets/images/service-$sl.jpg" ) ) { $missing[] = $sl; }
}
if ( $missing ) { echo 'NOTE: no bundled photo yet for: ' . implode( ', ', $missing ) . "\n"; }

/* ---------- approved copy ---------- */
$approved = array( 'tree-removal', 'tree-pruning', 'emergency-tree-service', 'plant-health-care', 'tree-inspection',
	'lot-land-clearing', 'brush-clean-up', 'brush-mowing', 'stump-grinding' );

foreach ( $approved as $sl ) {
	check( isset( $byslug[ $sl ] ), "approved service '$sl' present" );
	if ( ! isset( $byslug[ $sl ] ) ) { continue; }
	$a = $byslug[ $sl ];
	check( ! empty( $a['meta']['_jce_service_eyebrow'] ), "$sl has an approved eyebrow" );
	check( ! empty( $a['meta']['_jce_service_headline'] ), "$sl has an approved headline" );
	// Sections with no approved copy must be OFF, never silently falling back.
	foreach ( array( '_jce_service_signs', '_jce_service_included', '_jce_service_pricing', '_jce_service_faq' ) as $k ) {
		check( jce_field_is_off( $a['meta'][ $k ] ?? '' ), "$sl: $k is switched off, not falling back to example copy" );
	}
}

/*
 * Tree Pruning's copy is now approved and pasted in here, same as the other
 * eight — it no longer needs (or has) the protect flag. check-importer.php
 * separately proves the protect mechanism itself still works, with its own
 * synthetic protected post, so that guard stays exercised even with nothing
 * in this file currently using it.
 */
check( empty( $byslug['tree-pruning']['protect'] ?? false ), 'tree-pruning no longer needs protect — its copy lives here now' );

// The importer mechanism itself must still exist and run before any write,
// even though nothing in this file currently sets it.
$dc    = file_get_contents( "$THEME/inc/demo-content.php" );
$guard = strpos( $dc, "! empty( \$item['protect'] )" );
$write = strpos( $dc, 'wp_insert_post(' );
check( false !== $guard, 'jce_demo_insert() still checks the protect flag' );
check( false !== $guard && false !== $write && $guard < $write,
	'the protect check runs before wp_insert_post(), not after' );

/* ---------- Tree Removal, the fullest page ---------- */
$tr = $byslug['tree-removal'];
check( $tr['title'] === 'Tree Removal', 'post title stays short for cards and menus' );
check( strlen( $tr['meta']['_jce_service_headline'] ) > 40, 'the long H1 lives in its own field' );
check( $byslug['tree-inspection']['title'] === 'Tree Inspection', 'Tree Inspection title matches its slug' );

$proof = jce_rows( $tr['meta']['_jce_service_proof'], 5 );
check( count( $proof ) === 2, 'two proof blocks' );
foreach ( $proof as $i => $r ) {
	check( $r[0] !== '', "proof $i has a heading" );
	check( $r[1] !== '' || $r[2] !== '', "proof $i has a body or a quote" );
	check( $r[4] !== '', "proof $i names the photo needed" );
}
check( str_contains( $proof[0][4], '//' ), 'proof block 1 requests a before/after pair' );
check( $proof[0][3] === 'Brian Gresback', 'quote and attribution are separate columns' );
check( count( jce_rows( $tr['meta']['_jce_service_subservices'], 2 ) ) === 6, 'six sub-services' );

/* ---------- every pipe row is complete ---------- */
$row_specs = array(
	'_jce_service_signs' => 2, '_jce_service_pricing' => 2, '_jce_service_faq' => 2,
	'_jce_service_subservices' => 2, '_jce_service_notes' => 2,
);
foreach ( $svc as $s ) {
	foreach ( $row_specs as $key => $cols ) {
		$raw = $s['meta'][ $key ] ?? '';
		if ( '' === $raw || jce_field_is_off( $raw ) ) { continue; }
		foreach ( jce_rows( $raw, $cols ) as $r ) {
			check( $r[0] !== '' && $r[1] !== '', "{$s['slug']} $key has an incomplete row: " . substr( $r[0], 0, 40 ) );
		}
	}
}

/* ---------- locations ---------- */
$loc     = jce_demo_locations();
$lslugs  = array_column( $loc, 'slug' );
check( count( array_unique( $lslugs ) ) === count( $lslugs ), 'location slugs unique' );
$primary = array_filter( $loc, fn( $l ) => 'primary' === $l['priority'] );
check( count( $primary ) === 3, 'three primary towns' );
foreach ( $primary as $l ) {
	check( in_array( $l['slug'], array( 'river-falls', 'hudson', 'prescott' ), true ), "primary town {$l['slug']} has a bundled photo" );
	// Optional sections: the brief has no approved copy for neighborhoods,
	// local conditions, or a per-town FAQ, so they are absent by design. What
	// matters is that anything present is well formed.
	foreach ( array( '_jce_location_conditions' => 2, '_jce_location_faq' => 2 ) as $key => $cols ) {
		$raw = $l['meta'][ $key ] ?? '';
		if ( '' === $raw || jce_field_is_off( $raw ) ) { continue; }
		foreach ( jce_rows( $raw, $cols ) as $r ) {
			check( $r[0] !== '' && $r[1] !== '', "{$l['slug']} $key has an incomplete row" );
		}
	}
}

/* ---------- pages ---------- */
$pages = jce_demo_pages();
$ptpl  = array_column( $pages, 'template', 'slug' );
check( ( $ptpl['about'] ?? '' ) === 'page-templates/template-about.php', 'about page template assigned' );
check( ( $ptpl['service-area'] ?? '' ) === 'page-templates/template-service-area.php', 'service-area page template assigned' );
check( ( $ptpl['services'] ?? '' ) === 'page-templates/template-services.php', 'services page template assigned' );
foreach ( $pages as $p ) {
	if ( empty( $p['template'] ) ) { continue; }
	check( file_exists( "$THEME/" . $p['template'] ), "template file exists: {$p['template']}" );
}
// Slugs the Customizer defaults link to. A drift here is a broken nav button.
foreach ( array( 'estimate', 'emergency-tree-service', 'service-area', 'about', 'services' ) as $slug ) {
	check( in_array( $slug, array_column( $pages, 'slug' ), true ), "load-bearing page slug '$slug' is created by the importer" );
}

/* ---------- page section fields: rendered, saved, and read ---------- */
$mb    = file_get_contents( "$THEME/inc/meta-boxes.php" );
$about = file_get_contents( "$THEME/page-templates/template-about.php" );
preg_match_all( '/_jce_page_[a-z_]+/', $about, $used );
foreach ( array_unique( $used[0] ) as $field ) {
	$bare = ltrim( $field, '_' );
	check( str_contains( $mb, "'$bare'" ), "$field has an input in the Page Sections box" );
	check( preg_match( "/'jce_page_sections'.*?$bare/s", $mb ) === 1, "$field is registered for saving" );
}

// Town cards must tolerate a town with no excerpt and no body — which is
// every town right now, since approved location copy is still pending.
foreach ( array( 'template-parts/service-area.php', 'template-parts/locations-grid.php' ) as $part ) {
	$src = file_get_contents( "$THEME/$part" );
	check( str_contains( $src, '$card_summary' ),
		"$part guards the card summary so an empty excerpt does not render a bare <p>" );
}

/*
 * No template part may keep a hardcoded fallback list of marketing copy.
 *
 * Those lists publish invented text under the client's name, and they go stale
 * silently — the services grid was still advertising eight services and a
 * "Brush Clean Up & Mowing" months after that service had been split in two.
 * A part with nothing real to show renders nothing instead.
 *
 * Scoped to fallback *variables* on purpose: section headings, button labels,
 * and aria-labels are chrome, not copy, and belong in the template.
 */
foreach ( glob( "$THEME/template-parts/*.php" ) as $part ) {
	$src  = file_get_contents( $part );
	$name = basename( $part );

	if ( preg_match_all( '/\$\w*fallback\w*\s*=\s*array\s*\(/i', $src, $m ) ) {
		check( false, "$name still has " . count( $m[0] ) . ' hardcoded fallback copy array(s)' );
	}
}

// Both listings must bail rather than render a heading over an empty grid.
foreach ( array( 'services-grid.php', 'service-area.php' ) as $part ) {
	$src = file_get_contents( "$THEME/template-parts/$part" );
	check( preg_match( '/have_posts\(\)[^;]*\)\s*\{\s*return;/s', $src ) === 1
		|| preg_match( '/\breturn;/', $src ) === 1,
		"$part returns early when there is nothing to list" );
}

/* ---------- testimonials ---------- */
$tst = jce_demo_testimonials();
check( count( $tst ) >= 1, 'at least one testimonial' );
foreach ( $tst as $t ) {
	check( ! empty( $t['title'] ), 'testimonial has a name' );
	check( ! empty( $t['body'] ), "testimonial '{$t['title']}' has a quote" );
	$rating = $t['meta']['_jce_rating'] ?? 5;
	check( $rating >= 1 && $rating <= 5, "testimonial '{$t['title']}' has a valid rating" );
}
$valid = array_merge( $slugs, $lslugs );
// The tag is optional — an untagged review still shows in the general rotation.
// What must not happen is a tag pointing at a page that does not exist, which
// would silently filter the reviews section down to nothing.
foreach ( $tst as $t ) {
	$tag = $t['meta']['_jce_review_service'] ?? '';
	if ( '' === $tag ) { continue; }
	check( in_array( $tag, $valid, true ), "review tag '$tag' resolves to a real service or town" );
}

echo $fail ? "\n$fail CHECK(S) FAILED\n" : "check-content: all passed\n";
exit( $fail ? 1 : 0 );
