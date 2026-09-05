<?php
/**
 * Bundled photography.
 *
 * Real JCE job photos ship with the theme in assets/images/ so the site looks
 * finished on day one. They are only ever a FALLBACK: a Customizer hero image
 * or a post's Featured Image always wins, so the client can swap any photo
 * from WordPress without touching code.
 *
 * Source files live in content/photos/. Everything here was resized, cropped,
 * and re-encoded with EXIF stripped — these are photos of customers' homes and
 * the originals carry GPS coordinates.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URI for a file in the theme's image folder.
 */
function jce_img_uri( $file ) {
	return JCE_THEME_URI . '/assets/images/' . $file;
}

/**
 * Does a bundled image actually exist on disk?
 */
function jce_img_exists( $file ) {
	return file_exists( JCE_THEME_DIR . '/assets/images/' . $file );
}

/**
 * Bundled default hero per page context, with descriptive alt text.
 * Alt text names the town — it's read by screen readers and by image search.
 */
function jce_default_heroes() {
	return array(
		'home'      => array(
			'file' => 'hero-home.jpg',
			'alt'  => __( 'A JCE Tree Service crane lifts a limb from a large tree above a home in River Falls, Wisconsin', 'jce' ),
		),
		'services'  => array(
			'file' => 'hero-services.jpg',
			'alt'  => __( 'A JCE arborist works from a spider lift over the roof of a house during a tree removal', 'jce' ),
		),
		'about'     => array(
			'file' => 'hero-about.jpg',
			'alt'  => __( 'JCE Tree Service bucket trucks and chip trucks lined up on a residential street', 'jce' ),
		),
		'contact'   => array(
			'file' => 'hero-contact.jpg',
			'alt'  => __( 'A JCE bucket truck parked beneath a mature tree on a quiet residential street', 'jce' ),
		),
		'emergency' => array(
			'file' => 'hero-emergency.jpg',
			'alt'  => __( 'A large tree brought down across a lawn by a storm, waiting for emergency removal', 'jce' ),
		),
		'blog'      => array(
			'file' => 'hero-contact.jpg',
			'alt'  => __( 'A mature tree on a residential street in the St. Croix River Valley', 'jce' ),
		),
	);
}

/**
 * Resolve the hero image for a context.
 *
 * Priority: Customizer setting (home only) → Featured Image → bundled default.
 *
 * @return array{url:string,alt:string,srcset:string}|null
 */
function jce_hero_image( $context = 'home' ) {
	$defaults = jce_default_heroes();

	// 1. Customizer hero (homepage only).
	if ( 'home' === $context ) {
		$custom = jce_biz( 'hero_image' );
		if ( $custom ) {
			return array(
				'url'    => $custom,
				'alt'    => $defaults['home']['alt'],
				'srcset' => '',
			);
		}
	}

	// 2. Featured Image on the current post/page.
	if ( is_singular() && has_post_thumbnail() ) {
		$id = get_post_thumbnail_id();
		return array(
			'url'    => get_the_post_thumbnail_url( $id ? get_the_ID() : null, 'jce-hero' ),
			'alt'    => get_post_meta( $id, '_wp_attachment_image_alt', true ),
			'srcset' => (string) wp_get_attachment_image_srcset( $id, 'jce-hero' ),
		);
	}

	// 3. Bundled default.
	if ( isset( $defaults[ $context ] ) && jce_img_exists( $defaults[ $context ]['file'] ) ) {
		$file   = $defaults[ $context ]['file'];
		$srcset = '';

		// hero-home ships a second width for smaller viewports.
		$small = str_replace( '.jpg', '-1280.jpg', $file );
		if ( jce_img_exists( $small ) ) {
			$srcset = jce_img_uri( $small ) . ' 1280w, ' . jce_img_uri( $file ) . ' 1920w';
		}

		return array(
			'url'    => jce_img_uri( $file ),
			'alt'    => $defaults[ $context ]['alt'],
			'srcset' => $srcset,
		);
	}

	return null;
}

/**
 * Bundled service-card photos, keyed by the Service post slug.
 */
function jce_default_service_images() {
	return array(
		'tree-removal'           => array( 'service-tree-removal.jpg', __( 'A JCE crane lowers a large log section during a tree removal', 'jce' ) ),
		'tree-pruning'           => array( 'service-tree-pruning.jpg', __( 'A JCE arborist prunes a mature elm from a bucket truck', 'jce' ) ),
		'emergency-tree-service' => array( 'service-emergency-tree-service.jpg', __( 'A storm-broken limb resting on the roof of a house', 'jce' ) ),
		'plant-health-care'      => array( 'service-plant-health-care.jpg', __( 'The healthy green canopy of a mature shade tree against a blue sky', 'jce' ) ),
		'tree-inspection'        => array( 'service-tree-inspection.jpg', __( 'A JCE arborist inspects a large forked trunk from a bucket', 'jce' ) ),
		'lot-land-clearing'      => array( 'service-lot-land-clearing.jpg', __( 'A tracked skid steer with a forestry mulcher clearing wooded land', 'jce' ) ),
		'brush-clean-up'         => array( 'service-brush-clean-up.jpg', __( 'A JCE wood chipper processing brush on a job site', 'jce' ) ),
		// No bundled photo yet — the card falls back to the branded placeholder
		// until service-brush-mowing.jpg is added or a Featured Image is set.
		'brush-mowing'           => array( 'service-brush-mowing.jpg', __( 'A tracked brush mower clearing overgrown pasture and saplings', 'jce' ) ),
		'stump-grinding'         => array( 'service-stump-grinding.jpg', __( 'A grapple saw working a large stump after a tree removal', 'jce' ) ),
	);
}

/**
 * Bundled location photos, keyed by the Location post slug.
 */
function jce_default_location_images() {
	return array(
		'river-falls' => array( 'location-river-falls.jpg', __( 'JCE Tree Service trucks working a residential street in River Falls, Wisconsin', 'jce' ) ),
		'hudson'      => array( 'location-hudson.jpg', __( 'JCE equipment removing a large tree beside a home in Hudson, Wisconsin', 'jce' ) ),
		'prescott'    => array( 'location-prescott.jpg', __( 'A JCE crane working an oak in fall colour near Prescott, Wisconsin', 'jce' ) ),
	);
}

/**
 * Echo a card image: Featured Image → bundled default for the slug → placeholder.
 *
 * @param string $type 'service' or 'location'.
 */
function jce_card_image( $type = 'service', $post_id = null, $size = 'jce-card' ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, $size, array( 'loading' => 'lazy', 'decoding' => 'async' ) );
		return;
	}

	$map  = ( 'location' === $type ) ? jce_default_location_images() : jce_default_service_images();
	$slug = get_post_field( 'post_name', $post_id );

	if ( isset( $map[ $slug ] ) && jce_img_exists( $map[ $slug ][0] ) ) {
		printf(
			'<img src="%s" alt="%s" width="800" height="500" loading="lazy" decoding="async">',
			esc_url( jce_img_uri( $map[ $slug ][0] ) ),
			esc_attr( $map[ $slug ][1] )
		);
		return;
	}

	jce_media_placeholder( 'media-ph--wide' );
}

/**
 * Echo a bundled image directly by filename, falling back to the placeholder.
 */
function jce_bundled_image( $file, $alt = '', $w = 900, $h = 1200, $modifier = '', $label = '' ) {
	if ( jce_img_exists( $file ) ) {
		printf(
			'<img src="%s" alt="%s" width="%d" height="%d" loading="lazy" decoding="async">',
			esc_url( jce_img_uri( $file ) ),
			esc_attr( $alt ),
			(int) $w,
			(int) $h
		);
		return;
	}
	jce_media_placeholder( $modifier, $label );
}
