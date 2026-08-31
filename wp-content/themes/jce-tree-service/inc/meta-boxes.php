<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------------------------------------------------------------
 * Service meta: homepage tile icon
 * ------------------------------------------------------------- */
function jce_add_service_meta_box() {
	add_meta_box( 'jce_service_icon', __( 'Homepage Tile Icon', 'jce' ), 'jce_render_service_meta_box', 'service', 'side' );
}
add_action( 'add_meta_boxes', 'jce_add_service_meta_box' );

function jce_render_service_meta_box( $post ) {
	wp_nonce_field( 'jce_save_service_meta', 'jce_service_meta_nonce' );
	$icon = get_post_meta( $post->ID, '_jce_service_icon', true );
	?>
	<p>
		<label for="jce_service_icon"><?php esc_html_e( 'Dashicon class (e.g. dashicons-hammer)', 'jce' ); ?></label>
		<input type="text" id="jce_service_icon" name="jce_service_icon" value="<?php echo esc_attr( $icon ); ?>" class="widefat">
	</p>
	<?php
}

/* ---------------------------------------------------------------
 * Location meta: primary vs. secondary town
 * ------------------------------------------------------------- */
function jce_add_location_meta_box() {
	add_meta_box( 'jce_location_priority', __( 'Location Priority', 'jce' ), 'jce_render_location_meta_box', 'location', 'side' );
}
add_action( 'add_meta_boxes', 'jce_add_location_meta_box' );

function jce_render_location_meta_box( $post ) {
	wp_nonce_field( 'jce_save_location_meta', 'jce_location_meta_nonce' );
	$priority = get_post_meta( $post->ID, '_jce_location_priority', true );
	if ( ! $priority ) {
		$priority = 'primary';
	}
	?>
	<p>
		<label>
			<input type="radio" name="jce_location_priority" value="primary" <?php checked( $priority, 'primary' ); ?>>
			<?php esc_html_e( 'Primary (River Falls, Hudson, Prescott)', 'jce' ); ?>
		</label><br>
		<label>
			<input type="radio" name="jce_location_priority" value="secondary" <?php checked( $priority, 'secondary' ); ?>>
			<?php esc_html_e( 'Secondary service town', 'jce' ); ?>
		</label>
	</p>
	<?php
}

/* ---------------------------------------------------------------
 * Testimonial meta: reviewer details (feeds Review schema)
 * ------------------------------------------------------------- */
function jce_add_testimonial_meta_box() {
	add_meta_box( 'jce_testimonial_details', __( 'Review Details', 'jce' ), 'jce_render_testimonial_meta_box', 'testimonial', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'jce_add_testimonial_meta_box' );

function jce_render_testimonial_meta_box( $post ) {
	wp_nonce_field( 'jce_save_testimonial_meta', 'jce_testimonial_meta_nonce' );
	$location = get_post_meta( $post->ID, '_jce_reviewer_location', true );
	$job      = get_post_meta( $post->ID, '_jce_job_type', true );
	$rating   = get_post_meta( $post->ID, '_jce_rating', true );
	if ( ! $rating ) {
		$rating = '5';
	}
	$source = get_post_meta( $post->ID, '_jce_review_source', true );
	?>
	<p>
		<label for="jce_reviewer_location"><?php esc_html_e( 'Town / Street (e.g. "Cedar Street, River Falls")', 'jce' ); ?></label>
		<input type="text" id="jce_reviewer_location" name="jce_reviewer_location" value="<?php echo esc_attr( $location ); ?>" class="widefat">
	</p>
	<p>
		<label for="jce_job_type"><?php esc_html_e( 'Job (e.g. "Large ash removal")', 'jce' ); ?></label>
		<input type="text" id="jce_job_type" name="jce_job_type" value="<?php echo esc_attr( $job ); ?>" class="widefat">
	</p>
	<p>
		<label for="jce_rating"><?php esc_html_e( 'Star Rating', 'jce' ); ?></label>
		<select id="jce_rating" name="jce_rating">
			<?php foreach ( array( 5, 4, 3, 2, 1 ) as $n ) : ?>
				<option value="<?php echo esc_attr( $n ); ?>" <?php selected( $rating, (string) $n ); ?>><?php echo esc_html( $n ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="jce_review_source"><?php esc_html_e( 'Source (Google, Facebook, HomeAdvisor...)', 'jce' ); ?></label>
		<input type="text" id="jce_review_source" name="jce_review_source" value="<?php echo esc_attr( $source ); ?>" class="widefat">
	</p>
	<?php
}

/* ---------------------------------------------------------------
 * Save handler for all meta boxes above
 * ------------------------------------------------------------- */
function jce_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['jce_service_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_service_meta_nonce'] ) ), 'jce_save_service_meta' ) ) {
		if ( isset( $_POST['jce_service_icon'] ) ) {
			update_post_meta( $post_id, '_jce_service_icon', sanitize_html_class( wp_unslash( $_POST['jce_service_icon'] ) ) );
		}
	}

	if ( isset( $_POST['jce_location_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_location_meta_nonce'] ) ), 'jce_save_location_meta' ) ) {
		if ( isset( $_POST['jce_location_priority'] ) ) {
			update_post_meta( $post_id, '_jce_location_priority', sanitize_key( wp_unslash( $_POST['jce_location_priority'] ) ) );
		}
	}

	if ( isset( $_POST['jce_testimonial_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_testimonial_meta_nonce'] ) ), 'jce_save_testimonial_meta' ) ) {
		$fields = array( 'jce_reviewer_location', 'jce_job_type', 'jce_review_source' );
		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
		if ( isset( $_POST['jce_rating'] ) ) {
			update_post_meta( $post_id, '_jce_rating', absint( $_POST['jce_rating'] ) );
		}
	}
}
add_action( 'save_post', 'jce_save_meta_boxes' );
