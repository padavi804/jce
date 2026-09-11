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
 * Is this field explicitly switched off?
 *
 * Empty and off have to mean different things. Empty means "nothing typed
 * here yet", and falls back to example copy so a half-built page still reads
 * as finished. But a page carrying approved copy often has no use for a
 * section at all, and there the fallback is actively wrong — it publishes
 * invented text under the client's name.
 *
 * So a field containing a single dash means "render nothing".
 *
 * @param string $raw Raw meta value.
 */
function jce_field_is_off( $raw ) {
	return in_array( strtolower( trim( (string) $raw ) ), array( '-', 'none', 'hide', 'off' ), true );
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
	$raw     = get_post_meta( $post_id, $key, true );

	if ( jce_field_is_off( $raw ) ) {
		return array();
	}

	$lines = jce_lines( $raw );

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
	$raw     = get_post_meta( $post_id, $key, true );

	if ( jce_field_is_off( $raw ) ) {
		return array();
	}

	$rows = jce_rows( $raw, $columns );

	return $rows ? $rows : $fallback;
}

/**
 * Read a post meta field as a list of attachment IDs, positionally matched to
 * the rows of a companion jce_field_rows()/jce_field_lines() field — see
 * jce_field_photo_slots().
 *
 * @param string   $key     Meta key.
 * @param int|null $post_id Defaults to the current post.
 * @return int[] Zero where a row has no photo, so callers can index into it
 *               the same way they index into the matching rows array.
 */
function jce_field_ids( $key, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$raw     = get_post_meta( $post_id, $key, true );

	if ( '' === trim( (string) $raw ) ) {
		return array();
	}

	return array_map( 'absint', explode( ',', $raw ) );
}

/**
 * Read a single-value post meta field.
 */
function jce_field( $key, $post_id = null, $fallback = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$value   = get_post_meta( $post_id, $key, true );

	if ( jce_field_is_off( $value ) ) {
		return '';
	}

	return ( '' === $value || null === $value ) ? $fallback : $value;
}

/**
 * Join names into a readable sentence fragment: "A, B, and C".
 *
 * @param string[] $items
 * @param string   $conjunction
 */
function jce_list_sentence( $items, $conjunction = 'and' ) {
	$items = array_values( array_filter( array_map( 'trim', (array) $items ) ) );
	$count = count( $items );

	if ( ! $count ) {
		return '';
	}
	if ( 1 === $count ) {
		return $items[0];
	}
	if ( 2 === $count ) {
		return $items[0] . ' ' . $conjunction . ' ' . $items[1];
	}

	$last = array_pop( $items );

	return implode( ', ', $items ) . ', ' . $conjunction . ' ' . $last;
}

/**
 * The "Proudly serving…" line, built from the Location posts.
 *
 * Generated rather than typed so it cannot drift: adding a town in WordPress
 * updates this sentence everywhere it appears. Primary towns lead, secondary
 * towns follow after "plus".
 */
function jce_area_sentence() {
	$fetch = static function ( $priority ) {
		$args = array(
			'post_type'      => 'location',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
			'fields'         => 'ids',
		);

		$args['meta_query'] = ( 'primary' === $priority ) // phpcs:ignore WordPress.DB.SlowDBQuery
			? array(
				'relation' => 'OR',
				array( 'key' => '_jce_location_priority', 'value' => 'primary' ),
				array( 'key' => '_jce_location_priority', 'compare' => 'NOT EXISTS' ),
			)
			: array( array( 'key' => '_jce_location_priority', 'value' => 'secondary' ) );

		// Town pages are titled "Hudson, WI"; the sentence reads better with
		// just the town, and the state is already established by context.
		return array_map(
			static function ( $id ) {
				return trim( preg_replace( '/,\s*(WI|MN)\s*$/i', '', get_the_title( $id ) ) );
			},
			get_posts( $args )
		);
	};

	$primary   = $fetch( 'primary' );
	$secondary = $fetch( 'secondary' );

	if ( ! $primary ) {
		$primary   = array( 'River Falls', 'Hudson', 'Prescott' );
		$secondary = array( 'Ellsworth', 'Beldenville', 'Roberts', 'Houlton', 'Hammond', 'Baldwin', 'New Richmond', 'Spring Valley', 'Hastings', 'Afton', 'Lake St. Croix Beach', 'Lakeland' );
	}

	$sentence = sprintf(
		/* translators: %s: list of primary towns */
		__( 'Proudly serving %s', 'jce' ),
		jce_list_sentence( $primary )
	);

	if ( $secondary ) {
		$sentence .= sprintf(
			/* translators: %s: list of secondary towns */
			__( ', plus %s', 'jce' ),
			jce_list_sentence( $secondary )
		);
	}

	return $sentence . '.';
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
 * jce_band(), but only when the section is actually going to render.
 *
 * A section whose field is empty or switched off returns before printing
 * anything. If it had still taken a turn from the alternator, the sections
 * either side of it would both land on the same ground — switch off one
 * section and two visible ones collide on white.
 *
 * So pass the same condition the section itself will test:
 *
 *     'class' => jce_band_if( $rows ),
 *
 * @param mixed $will_render Truthy if the section has content to show.
 */
function jce_band_if( $will_render ) {
	return $will_render ? jce_band() : '';
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
 * Sanitize a comma-separated list of attachment IDs, as written by the photo
 * slots panel. Empty slots are kept as empty strings rather than dropped, so
 * position — which is what matches a photo to its row — survives a partial
 * save.
 */
function jce_sanitize_id_list( $value ) {
	$ids = explode( ',', (string) wp_unslash( $value ) );

	$ids = array_map(
		static function ( $id ) {
			$id = trim( $id );
			return '' === $id ? '' : (string) absint( $id );
		},
		$ids
	);

	return implode( ',', $ids );
}

/**
 * Render the photo-slots panel that pairs one image with each line of a
 * companion textarea (e.g. "The List" on a Service).
 *
 * There's no way to keep a JS-driven picker in sync with a textarea on every
 * keystroke without it fighting the admin's typing, so this instead reads
 * the textarea's current lines on demand, when "Match Photo Slots" is
 * clicked — see assets/js/admin-photo-slots.js. Rows are matched to lines by
 * position: reordering lines in the textarea does not move their photos.
 *
 * @param string $name      Hidden field name (also the meta key).
 * @param string $value     Current comma-separated attachment IDs.
 * @param string $source_id HTML id of the textarea to read titles from.
 */
function jce_field_photo_slots( $name, $value, $source_id ) {
	?>
	<div class="jce-photo-slots" data-source="<?php echo esc_attr( $source_id ); ?>">
		<p class="jce-field__help description">
			<?php esc_html_e( 'Add a photo for any line above. Slots are matched by position, so after adding, removing, or reordering lines, click Match Photo Slots to List to line them back up.', 'jce' ); ?>
		</p>
		<button type="button" class="button jce-photo-slots__sync"><?php esc_html_e( 'Match Photo Slots to List', 'jce' ); ?></button>
		<div class="jce-photo-slots__rows"></div>
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" class="jce-photo-slots__value" value="<?php echo esc_attr( $value ); ?>">
	</div>
	<?php
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
		. '.jce-box__intro{margin:0 0 1.25em;padding:.75em 1em;background:#f0f6f1;border-left:4px solid #3CB460}'
		. '.jce-photo-slots{margin:-.25em 0 1.35em;padding:.9em 1em;background:#f6f7f7;border:1px solid #dcdcde}'
		. '.jce-photo-slots__rows{margin-top:.75em}'
		. '.jce-photo-slot{display:flex;align-items:center;gap:.75em;padding:.5em 0;border-top:1px solid #e2e2e2}'
		. '.jce-photo-slot:first-child{border-top:0}'
		. '.jce-photo-slot__thumb{flex:0 0 72px;width:72px;height:45px;background:#e2e2e2;overflow:hidden}'
		. '.jce-photo-slot__thumb img{display:block;width:100%;height:100%;object-fit:cover}'
		. '.jce-photo-slot__title{flex:1 1 auto}'
		. '.jce-photo-slot__remove{color:#b32d2e}';

	wp_register_style( 'jce-admin', false, array(), JCE_THEME_VERSION );
	wp_enqueue_style( 'jce-admin' );
	wp_add_inline_style( 'jce-admin', $css );
}
add_action( 'admin_enqueue_scripts', 'jce_meta_box_styles' );
