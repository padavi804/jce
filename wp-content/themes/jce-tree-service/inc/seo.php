<?php
/**
 * Baseline SEO output: meta description, canonical, and Open Graph tags.
 *
 * These only fire when no dedicated SEO plugin is active, so installing Yoast
 * or Rank Math later won't produce duplicate tags.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jce_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || class_exists( 'The_SEO_Framework\\Load' );
}

/**
 * Best-available description for the current view.
 */
function jce_meta_description() {
	$desc = '';

	if ( is_singular() ) {
		$custom = get_post_meta( get_the_ID(), '_jce_meta_description', true );
		if ( $custom ) {
			$desc = $custom;
		} elseif ( has_excerpt() ) {
			$desc = get_the_excerpt();
		} else {
			$desc = wp_trim_words( wp_strip_all_tags( strip_shortcodes( get_the_content() ) ), 30, '' );
		}
	} elseif ( is_post_type_archive( 'service' ) ) {
		$desc = __( 'Tree removal, pruning, emergency storm response, and plant health care from ISA-certified arborists serving River Falls, Hudson, and Prescott, WI.', 'jce' );
	} elseif ( is_home() ) {
		$desc = __( 'Seasonal tree care advice from the JCE Tree Service arborists in River Falls, Hudson, and Prescott, Wisconsin.', 'jce' );
	} else {
		$desc = get_bloginfo( 'description' );
	}

	return trim( wp_strip_all_tags( $desc ) );
}

function jce_output_seo_meta() {
	if ( jce_seo_plugin_active() ) {
		return;
	}

	$desc = jce_meta_description();
	if ( $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $desc, 160, '…' ) ) );
	}

	// Canonical.
	$canonical = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
	if ( is_front_page() || ( 'page' === get_option( 'show_on_front' ) && is_page( (int) get_option( 'page_on_front' ) ) ) ) {
		$canonical = home_url( '/' );
	}
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );

	// Open Graph / Twitter — controls how links look when shared, including in
	// the Google Business Profile and Facebook posts JCE already runs.
	$title = wp_get_document_title();
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular( 'post' ) ? 'article' : 'website' );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canonical ) );
	if ( $desc ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $desc, 200, '…' ) ) );
	}

	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( get_the_ID(), 'jce-hero' );
	} elseif ( jce_biz( 'hero_image' ) ) {
		$image = jce_biz( 'hero_image' );
	} elseif ( has_custom_logo() ) {
		$logo  = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$image = $logo ? $logo[0] : '';
	}
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	}
}
add_action( 'wp_head', 'jce_output_seo_meta', 2 );

/**
 * The page assigned as the static front page is still reachable at its own
 * permalink (e.g. /home/), where WordPress's template hierarchy treats it as
 * a normal page instead of the front page — is_front_page() is only true for
 * the root query, so /home/ falls through to page.php and renders without
 * any of the front-page.php sections. Sending that URL back to / keeps one
 * canonical homepage instead of two different-looking versions of it.
 */
function jce_redirect_front_page_slug() {
	if ( is_admin() || is_preview() || empty( $_SERVER['REQUEST_METHOD'] ) || 'GET' !== $_SERVER['REQUEST_METHOD'] ) {
		return;
	}

	if ( 'page' !== get_option( 'show_on_front' ) ) {
		return;
	}

	$front_id = (int) get_option( 'page_on_front' );
	if ( ! $front_id || ! is_page( $front_id ) || is_front_page() ) {
		return;
	}

	wp_safe_redirect( home_url( '/' ), 301 );
	exit;
}
add_action( 'template_redirect', 'jce_redirect_front_page_slug' );

/**
 * Meta description field on posts, pages, and the custom post types.
 */
function jce_add_seo_meta_box() {
	$screens = array( 'post', 'page', 'service', 'location', 'landing_page' );
	add_meta_box( 'jce_seo', __( 'Search Snippet', 'jce' ), 'jce_render_seo_meta_box', $screens, 'normal', 'low' );
}
add_action( 'add_meta_boxes', 'jce_add_seo_meta_box' );

function jce_render_seo_meta_box( $post ) {
	wp_nonce_field( 'jce_save_seo_meta', 'jce_seo_meta_nonce' );
	$desc = get_post_meta( $post->ID, '_jce_meta_description', true );
	?>
	<p>
		<label for="jce_meta_description"><strong><?php esc_html_e( 'Meta description', 'jce' ); ?></strong><br>
		<span class="description"><?php esc_html_e( 'The sentence Google shows under the page title. Aim for 150–160 characters, and name the town. Leave blank to auto-generate from the excerpt.', 'jce' ); ?></span></label>
		<textarea id="jce_meta_description" name="jce_meta_description" rows="3" class="widefat"><?php echo esc_textarea( $desc ); ?></textarea>
	</p>
	<?php
}

function jce_save_seo_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['jce_seo_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_seo_meta_nonce'] ) ), 'jce_save_seo_meta' ) ) {
		return;
	}
	if ( isset( $_POST['jce_meta_description'] ) ) {
		update_post_meta( $post_id, '_jce_meta_description', sanitize_textarea_field( wp_unslash( $_POST['jce_meta_description'] ) ) );
	}
}
add_action( 'save_post', 'jce_save_seo_meta' );

