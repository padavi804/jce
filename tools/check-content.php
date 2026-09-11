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
	check( ! empty( $s['excerpt'] ), "{$s['slug']} has an excerpt" );
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
$approved = array( 'tree-removal', 'emergency-tree-service', 'plant-health-care', 'tree-inspection',
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

// Tree Pruning is the one service still awaiting approved copy.
check( isset( $byslug['tree-pruning'] ), 'tree-pruning still present' );
check( ! jce_field_is_off( $byslug['tree-pruning']['meta']['_jce_service_faq'] ?? '' ),
	'tree-pruning still uses placeholder copy (no approved text supplied yet)' );

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
	check( count( jce_lines( $l['meta']['_jce_location_neighborhoods'] ) ) >= 4, "{$l['slug']} lists neighborhoods" );
}

/* ---------- pages ---------- */
$pages = jce_demo_pages();
$ptpl  = array_column( $pages, 'template', 'slug' );
check( ( $ptpl['about'] ?? '' ) === 'page-templates/template-about.php', 'about page template assigned' );
check( ( $ptpl['service-area'] ?? '' ) === 'page-templates/template-service-area.php', 'service-area page template assigned' );
foreach ( $pages as $p ) {
	if ( empty( $p['template'] ) ) { continue; }
	check( file_exists( "$THEME/" . $p['template'] ), "template file exists: {$p['template']}" );
}
// Slugs the Customizer defaults link to. A drift here is a broken nav button.
foreach ( array( 'estimate', 'emergency-tree-service', 'service-area', 'about' ) as $slug ) {
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

/* ---------- testimonials ---------- */
$tst = jce_demo_testimonials();
check( count( $tst ) >= 5, 'testimonials present' );
$valid = array_merge( $slugs, $lslugs );
foreach ( $tst as $t ) {
	check( in_array( $t['meta']['_jce_review_service'], $valid, true ),
		"review tag '{$t['meta']['_jce_review_service']}' resolves to a real service or town" );
}

echo $fail ? "\n$fail CHECK(S) FAILED\n" : "check-content: all passed\n";
exit( $fail ? 1 : 0 );
