<?php
/**
 * Section-ground checks.
 *
 * Sections render conditionally — a field switched off with a dash returns
 * before printing anything — so which sections land on cream cannot be
 * hardcoded. jce_band() alternates, and jce_band_if() lets a section that
 * will not render decline its turn. Skip that and switching one section off
 * puts the two visible sections either side of it on the same ground.
 *
 * Run:  php tools/check-bands.php
 */

$THEME = __DIR__ . '/../wp-content/themes/jce-tree-service';

define( 'ABSPATH', 1 );
function __( $s, $d = null ) { return $s; }
function add_action() {}
function add_filter() {}
function get_post_meta() { return ''; }
function get_the_ID() { return 1; }
function sanitize_text_field( $s ) { return $s; }

require "$THEME/inc/fields.php";

$fail = 0;

/**
 * @param array $sections [ name, renders?, is_dark? ]
 */
function run( $label, $sections ) {
	global $fail;
	jce_band( 'dark' ); // Every page opens on a dark hero.

	$emitted = array();
	foreach ( $sections as list( $name, $renders, $dark ) ) {
		if ( $dark ) {
			$emitted[] = array( $name, 'DARK' );
			jce_band( 'dark' );
			continue;
		}
		$class = jce_band_if( $renders );
		if ( $renders ) {
			$emitted[] = array( $name, $class ? 'cream' : 'white' );
		}
	}

	$prev = null;
	foreach ( $emitted as list( $name, $ground ) ) {
		if ( null !== $prev && $ground === $prev && 'DARK' !== $ground ) {
			echo "FAIL [$label]: '$name' collides — two consecutive $ground bands\n";
			$fail++;
		}
		$prev = $ground;
	}

	$parts = array();
	foreach ( $emitted as list( $name, $ground ) ) { $parts[] = "$name=$ground"; }
	echo '  ' . str_pad( $label, 20 ) . implode( '  ', $parts ) . "\n";
}

// Tree Removal: no editor body, and signs / scope / faq switched off.
run( 'Tree Removal', array(
	array( 'content', false, false ), array( 'steps', true, false ), array( 'proof', true, false ),
	array( 'sub-services', true, false ), array( 'signs', false, false ), array( 'scope', false, false ),
	array( 'credentials', true, true ), array( 'faq', false, false ), array( 'area', true, false ),
	array( 'reviews', true, false ), array( 'related', true, false ),
) );

// An approved service with body copy but the same four sections off.
run( 'Approved service', array(
	array( 'content', true, false ), array( 'steps', true, false ), array( 'proof', false, false ),
	array( 'sub-services', false, false ), array( 'signs', false, false ), array( 'scope', false, false ),
	array( 'credentials', true, true ), array( 'faq', false, false ), array( 'area', true, false ),
	array( 'reviews', true, false ), array( 'related', true, false ),
) );

// Tree Pruning: still on placeholder copy, so everything renders.
run( 'Full placeholder', array(
	array( 'content', true, false ), array( 'steps', true, false ), array( 'proof', false, false ),
	array( 'sub-services', false, false ), array( 'signs', true, false ), array( 'scope', true, false ),
	array( 'credentials', true, true ), array( 'faq', true, false ), array( 'area', true, false ),
	array( 'reviews', true, false ), array( 'related', true, false ),
) );

// The regression this exists for: an odd number of skipped sections mid-run.
run( 'One section off', array(
	array( 'sub-services', true, false ), array( 'signs', false, false ), array( 'scope', true, false ),
) );

// Templates must never take a band eagerly for a section that can switch off.
$svc = file_get_contents( "$THEME/single-service.php" );
foreach ( array( 'proof_rows', 'sub_rows', 'signs_rows', 'faq_rows' ) as $var ) {
	if ( ! preg_match( '/jce_band_if\(\s*\$' . $var . '/', $svc ) ) {
		echo "FAIL: \$$var section does not use jce_band_if()\n";
		$fail++;
	}
}

echo $fail ? "\n$fail BAND FAILURE(S)\n" : "check-bands: no collisions\n";
exit( $fail ? 1 : 0 );
