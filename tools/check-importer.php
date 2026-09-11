<?php
/**
 * Importer safety check.
 *
 * Runs jce_demo_insert() against a stand-in database to prove, rather than
 * assume, that a protected post is never written to — in either import mode —
 * while an unprotected one still updates normally in Replace mode.
 *
 * Uses a synthetic protected item rather than a real service, so this stays
 * true regardless of which (if any) service in inc/demo-content.php currently
 * carries the protect flag. The scenario it guards against: a service whose
 * approved copy was entered directly in WordPress, with none held in this
 * file. Without the guard, a Replace run would overwrite that approved copy
 * with nothing at all, destroying the only copy of it.
 *
 * Run:  php tools/check-importer.php
 */
$THEME = __DIR__ . '/../wp-content/themes/jce-tree-service';
define( 'ABSPATH', 1 );
define( 'OBJECT', 'OBJECT' );

function __( $s, $d = null ) { return $s; }
function add_action() {}
function add_filter() {}
function get_the_ID() { return 1; }
function sanitize_text_field( $s ) { return $s; }
function esc_html( $s ) { return $s; }
function esc_attr( $s ) { return $s; }
function esc_url_raw( $s ) { return $s; }
function sanitize_title( $s ) { return $s; }
function wp_specialchars_decode( $s ) { return $s; }
function wp_unslash( $s ) { return $s; }
function get_theme_mod( $k, $d = '' ) { return $d; }
function get_post_meta() { return ''; }
function flush_rewrite_rules() {}
function is_wp_error( $x ) { return false; }
function get_post_field( $f, $id ) { return $GLOBALS['CURRENT_SLUG']; }

$GLOBALS['DB']     = array(); // slug => [ 'content' => .., 'excerpt' => .. ]
$GLOBALS['WRITES'] = array();

function get_page_by_path( $slug, $out = null, $type = 'post' ) {
	if ( ! isset( $GLOBALS['DB'][ $slug ] ) ) { return null; }
	return (object) array( 'ID' => 99, 'post_name' => $slug );
}
function wp_insert_post( $fields, $err = false ) {
	$GLOBALS['WRITES'][] = $fields;
	$slug                = $fields['post_name'] ?? $GLOBALS['CURRENT_SLUG'];
	$GLOBALS['DB'][ $slug ] = array( 'content' => $fields['post_content'], 'excerpt' => $fields['post_excerpt'] );
	return 99;
}
function update_post_meta() {}

require "$THEME/inc/fields.php";
require "$THEME/inc/customizer.php";
require "$THEME/inc/demo-content.php";

$fail = 0;

/* ---------- a protected item must survive both modes ---------- */
$GLOBALS['CURRENT_SLUG'] = 'protected-example';
$GLOBALS['DB']['protected-example'] = array(
	'content' => 'APPROVED COPY ENTERED IN WORDPRESS',
	'excerpt' => 'APPROVED EXCERPT',
);

$protected_item = array(
	'slug'    => 'protected-example',
	'title'   => 'Protected Example',
	'order'   => 1,
	'excerpt' => 'placeholder — must never be written',
	'body'    => 'placeholder — must never be written',
	'protect' => true,
);

foreach ( array( false, true ) as $replace ) {
	$GLOBALS['WRITES'] = array();
	$log               = array();
	$result            = jce_demo_insert( 'service', $protected_item, $log, $replace );
	$mode              = $replace ? 'REPLACE mode' : 'normal mode';

	if ( $GLOBALS['WRITES'] ) {
		echo "FAIL: $mode wrote to a protected post\n";
		$fail++;
	}
	if ( 'APPROVED COPY ENTERED IN WORDPRESS' !== $GLOBALS['DB']['protected-example']['content'] ) {
		echo "FAIL: $mode destroyed the approved copy\n";
		$fail++;
	}
	if ( 'skipped' !== $result ) {
		echo "FAIL: $mode returned '$result', expected 'skipped'\n";
		$fail++;
	}
	echo '  ' . $mode . ': ' . trim( $log[0] ) . "\n";
}

/* ---------- control: an unprotected item MUST still be replaceable ---------- */
$GLOBALS['CURRENT_SLUG']              = 'unprotected-example';
$GLOBALS['DB']['unprotected-example'] = array( 'content' => 'old', 'excerpt' => 'old' );

$unprotected_item = array(
	'slug'    => 'unprotected-example',
	'title'   => 'Unprotected Example',
	'order'   => 1,
	'excerpt' => 'new approved copy',
	'body'    => 'new approved copy',
);

$GLOBALS['WRITES'] = array();
$log               = array();
$r                 = jce_demo_insert( 'service', $unprotected_item, $log, true );

if ( 'updated' !== $r ) {
	echo "FAIL: unprotected item was not updated in replace mode (got '$r')\n";
	$fail++;
} else {
	echo "  control: an unprotected item still updates in replace mode\n";
}

/* ---------- current state of inc/demo-content.php, informational ---------- */
$protected_now = array();
foreach ( jce_demo_services() as $s ) {
	if ( ! empty( $s['protect'] ) ) { $protected_now[] = $s['slug']; }
}
echo $protected_now
	? '  currently protected in demo-content.php: ' . implode( ', ', $protected_now ) . "\n"
	: "  nothing currently protected in demo-content.php (mechanism still verified above)\n";

echo $fail ? "\n$fail FAILURE(S)\n" : "\nprotect flag holds: approved WordPress copy survives both import modes\n";
exit( $fail ? 1 : 0 );
