<?php
/**
 * Repeatable content fields, stored as plain text.
 *
 * The page sections built out in this theme (signs you need a service, what's
 * included, price factors, FAQs, neighborhoods, milestones) are all lists of
 * one-to-three-part items. Rather than a JS repeater — which breaks on WP
 * updates and can't be pasted into — each list is a textarea: one item per
 * line, parts separated by a pipe.
 *
 *     Dead or dying|Bare branches in July mean the tree is gone, not dormant.
 *
 * That keeps every one of these sections editable from the WordPress admin by
 * someone who has never seen a custom field UI, and it survives copy/paste
 * from a Google Doc, which is how this content will actually arrive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Split a textarea value into trimmed, non-empty lines.
 *
 * @param string $value Raw field value.
 * @return string[]
 */
function jce_lines( $value ) {
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return array();
	}

	$lines = preg_split( '/\R/', $value );

	return array_values(
		array_filter(
			array_map( 'trim', $lines ),
			static function ( $line ) {
				return '' !== $line;
			}
		)
	);
}

/**
 * Split a textarea value into pipe-separated rows.
 *
 * Every row is padded out to $columns entries so callers can index into it
 * without checking — a line missing its second half yields an empty string
 * rather than a notice.
 *
 * @param string $value   Raw field value.
 * @param int    $columns Parts per row.
 * @return array<int,string[]>
 */
function jce_rows( $value, $columns = 2 ) {
	$rows = array();

	foreach ( jce_lines( $value ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, $columns ) );
		$rows[] = array_pad( $parts, $columns, '' );
	}

	return $rows;
}

/**
 * Read a post meta field as lines.
 *
 * @param string   $key      Meta key, without the leading underscore/prefix.
 * @param int|null $post_id  Defaults to the current post.
 * @param string[] $fallback Used when the field is empty, so a page never
 *                           renders a headed section with nothing under it.
 * @return string[]
 */
function jce_field_lines( $key, $post_id = null, $fallback = array() ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$lines   = jce_lines( get_post_meta( $post_id, $key, true ) );

	return $lines ? $lines : $fallback;
}

/**
 * Read a post meta field as pipe-separated rows.
 *
 * @param string  $key      Meta key.
 * @param int     $columns  Parts per row.
 * @param int|null $post_id Defaults to the current post.
 * @param array   $fallback Used when the field is empty.
 * @return array<int,string[]>
 */
function jce_field_rows( $key, $columns = 2, $post_id = null, $fallback = array() ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$rows    = jce_rows( get_post_meta( $post_id, $key, true ), $columns );

	return $rows ? $rows : $fallback;
}

/**
 * Read a single-value post meta field.
 */
function jce_field( $key, $post_id = null, $fallback = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$value   = get_post_meta( $post_id, $key, true );

	return ( '' === $value || null === $value ) ? $fallback : $value;
}

/**
 * Next alternating light ground for a section.
 *
 * Service and town pages emit sections conditionally — a town with no
 * neighborhoods listed skips that block entirely — so which sections land on
 * cream can't be hardcoded without white-on-white collisions appearing as soon
 * as a field is left empty.
 *
 * Call jce_band() for each light section in page order and pass the result as
 * its 'class'. Call jce_band( 'dark' ) after emitting a dark or green band:
 * that restarts the alternation on white, so a dark band is never followed
 * straight into cream.
 *
 * @param string $signal Pass 'dark' after a dark/green section.
 * @return string 'section--cream' or ''.
 */
function jce_band( $signal = '' ) {
	static $cream = false;

	if ( 'dark' === $signal ) {
		$cream = true; // So the next call flips back to white.
		return '';
	}

	$cream = ! $cream;

	return $cream ? 'section--cream' : '';
}

/**
 * Render a labelled textarea inside a meta box.
 *
 * @param string $name  Field name (also the meta key).
 * @param string $label Field label.
 * @param string $help  Format hint shown under the label.
 * @param string $value Current value.
 * @param int    $rows  Textarea height.
 */
function jce_field_textarea( $name, $label, $help, $value, $rows = 5 ) {
	?>
	<p class="jce-field">
		<label for="<?php echo esc_attr( $name ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label>
		<span class="jce-field__help description"><?php echo esc_html( $help ); ?></span>
		<textarea id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>"
			rows="<?php echo (int) $rows; ?>" class="widefat code"><?php echo esc_textarea( $value ); ?></textarea>
	</p>
	<?php
}

/**
 * Render a labelled single-line text input inside a meta box.
 */
function jce_field_text( $name, $label, $help, $value ) {
	?>
	<p class="jce-field">
		<label for="<?php echo esc_attr( $name ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label>
		<span class="jce-field__help description"><?php echo esc_html( $help ); ?></span>
		<input type="text" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>"
			value="<?php echo esc_attr( $value ); ?>" class="widefat">
	</p>
	<?php
}

/**
 * Sanitize a multi-line field. Line structure is preserved; each line is run
 * through sanitize_text_field, which would otherwise collapse the newlines.
 */
function jce_sanitize_lines( $value ) {
	$lines = preg_split( '/\R/', (string) wp_unslash( $value ) );
	$lines = array_map( 'sanitize_text_field', $lines );

	return trim( implode( "\n", $lines ) );
}

/**
 * Meta box styling — just enough to keep the format hints readable.
 */
function jce_meta_box_styles( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	$css = '.jce-field{margin:0 0 1.35em}'
		. '.jce-field label{display:block;margin-bottom:.15em}'
		. '.jce-field__help{display:block;margin-bottom:.4em;font-style:normal}'
		. '.jce-field textarea{font-size:12px;line-height:1.6}'
		. '.jce-box__intro{margin:0 0 1.25em;padding:.75em 1em;background:#f0f6f1;border-left:4px solid #3CB460}';

	wp_register_style( 'jce-admin', false, array(), JCE_THEME_VERSION );
	wp_enqueue_style( 'jce-admin' );
	wp_add_inline_style( 'jce-admin', $css );
}
add_action( 'admin_enqueue_scripts', 'jce_meta_box_styles' );
