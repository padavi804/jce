<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom post types so content lives in WordPress, not hardcoded in PHP:
 * - service:      Tree Removal, Pruning, Emergency, etc. Order via Page Attributes
 *                 (removal-first per the creative brief) drives the homepage grid.
 * - location:     River Falls, Hudson, Prescott + secondary towns.
 * - testimonial:  Reviews with the specifics (street, job, outcome) the brief
 *                 calls for — feeds both the on-page reviews section and Review schema.
 * - landing_page: One-off pages built to convert paid/LSA traffic, kept separate
 *                 from regular Pages so they're easy to find/retire per campaign.
 */
function jce_register_post_types() {

	register_post_type(
		'service',
		array(
			'labels'       => array(
				'name'          => __( 'Services', 'jce' ),
				'singular_name' => __( 'Service', 'jce' ),
				'add_new_item'  => __( 'Add New Service', 'jce' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'services' ),
			'menu_icon'    => 'dashicons-hammer',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'location',
		array(
			'labels'       => array(
				'name'          => __( 'Locations', 'jce' ),
				'singular_name' => __( 'Location', 'jce' ),
				'add_new_item'  => __( 'Add New Location', 'jce' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'service-area' ),
			'menu_icon'    => 'dashicons-location',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'testimonial',
		array(
			'labels'       => array(
				'name'          => __( 'Testimonials', 'jce' ),
				'singular_name' => __( 'Testimonial', 'jce' ),
				'add_new_item'  => __( 'Add New Testimonial', 'jce' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'testimonials' ),
			'menu_icon'    => 'dashicons-star-filled',
			'supports'     => array( 'title', 'editor' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'landing_page',
		array(
			'labels'       => array(
				'name'          => __( 'Landing Pages', 'jce' ),
				'singular_name' => __( 'Landing Page', 'jce' ),
				'add_new_item'  => __( 'Add New Landing Page', 'jce' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'lp' ),
			'menu_icon'    => 'dashicons-megaphone',
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'jce_register_post_types' );
