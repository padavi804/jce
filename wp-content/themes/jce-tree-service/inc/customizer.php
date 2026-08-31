<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Business Info panel — everything Joe's team is likely to change lives here
 * (Appearance > Customize > Business Info) rather than in PHP.
 */
function jce_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'jce_business_info',
		array(
			'title'       => __( 'Business Info', 'jce' ),
			'description' => __( 'Phone, address, ratings, and hero content used across the whole site.', 'jce' ),
			'priority'    => 20,
		)
	);

	$sections = array(
		'jce_contact'   => __( 'Contact & Location', 'jce' ),
		'jce_emergency' => __( 'Emergency Response', 'jce' ),
		'jce_hero'      => __( 'Homepage Hero', 'jce' ),
		'jce_trust'     => __( 'Trust Signals', 'jce' ),
		'jce_social'    => __( 'Social & Review Links', 'jce' ),
	);
	foreach ( $sections as $id => $label ) {
		$wp_customize->add_section( $id, array( 'title' => $label, 'panel' => 'jce_business_info' ) );
	}

	$text_settings = array(
		// Contact.
		'jce_phone'          => array( 'jce_contact', __( 'Phone Number', 'jce' ), '(715) 425-5555', 'sanitize_text_field' ),
		'jce_email'          => array( 'jce_contact', __( 'Email Address', 'jce' ), 'info@jcetree.com', 'sanitize_email' ),
		'jce_street_address' => array( 'jce_contact', __( 'Street Address', 'jce' ), '', 'sanitize_text_field' ),
		'jce_city'           => array( 'jce_contact', __( 'City', 'jce' ), 'River Falls', 'sanitize_text_field' ),
		'jce_state'          => array( 'jce_contact', __( 'State (abbr.)', 'jce' ), 'WI', 'sanitize_text_field' ),
		'jce_zip'            => array( 'jce_contact', __( 'ZIP Code', 'jce' ), '54022', 'sanitize_text_field' ),
		'jce_business_hours' => array( 'jce_contact', __( 'Business Hours', 'jce' ), 'Mon–Fri 7:00am–5:00pm', 'sanitize_text_field' ),
		'jce_estimate_url'   => array( 'jce_contact', __( 'Estimate Page URL', 'jce' ), '/estimate/', 'sanitize_text_field' ),

		// Emergency.
		'jce_emergency_phone' => array( 'jce_emergency', __( 'Emergency Phone (blank = main number)', 'jce' ), '', 'sanitize_text_field' ),
		'jce_emergency_url'   => array( 'jce_emergency', __( 'Emergency Page URL', 'jce' ), '/emergency-tree-service/', 'sanitize_text_field' ),
		'jce_emergency_label' => array( 'jce_emergency', __( 'Nav Button Label', 'jce' ), 'Storm Emergency', 'sanitize_text_field' ),
		'jce_emergency_note'  => array( 'jce_emergency', __( 'Availability Note', 'jce' ), '24/7 storm response', 'sanitize_text_field' ),

		// Hero.
		'jce_hero_headline'        => array( 'jce_hero', __( 'Hero Headline', 'jce' ), 'The Highest Standard of Tree Care.', 'sanitize_text_field' ),
		'jce_hero_headline_accent' => array( 'jce_hero', __( 'Headline Accent (shown in green, on its own line)', 'jce' ), 'No Exceptions.', 'sanitize_text_field' ),
		'jce_hero_subhead'         => array( 'jce_hero', __( 'Hero Subheadline', 'jce' ), 'Trusted in River Falls, Prescott, Hudson and the St. Croix River Valley for 25 years.', 'sanitize_text_field' ),

		// Trust.
		'jce_years_experience'     => array( 'jce_trust', __( 'Years in Business', 'jce' ), '25', 'sanitize_text_field' ),
		'jce_aggregate_rating'     => array( 'jce_trust', __( 'Star Rating (e.g. 4.9)', 'jce' ), '4.9', 'sanitize_text_field' ),
		'jce_review_count'         => array( 'jce_trust', __( 'Number of Reviews', 'jce' ), '', 'sanitize_text_field' ),
		'jce_arborist_count'       => array( 'jce_trust', __( 'ISA-Certified Arborists', 'jce' ), '4', 'sanitize_text_field' ),

		// Social.
		'jce_facebook_url'      => array( 'jce_social', __( 'Facebook URL', 'jce' ), '', 'esc_url_raw' ),
		'jce_instagram_url'     => array( 'jce_social', __( 'Instagram URL', 'jce' ), '', 'esc_url_raw' ),
		'jce_google_review_url' => array( 'jce_social', __( 'Google Business Profile URL', 'jce' ), '', 'esc_url_raw' ),
	);

	foreach ( $text_settings as $id => $args ) {
		list( $section, $label, $default, $sanitize ) = $args;
		$wp_customize->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize ) );
		$wp_customize->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => 'text' ) );
	}

	// Hero background image.
	$wp_customize->add_setting( 'jce_hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'jce_hero_image',
			array(
				'label'       => __( 'Hero Background Image', 'jce' ),
				'description' => __( 'JCE crew on a property. Use a wide shot at least 1920px across. Until one is set, a branded placeholder is shown.', 'jce' ),
				'section'     => 'jce_hero',
			)
		)
	);
}
add_action( 'customize_register', 'jce_customize_register' );

/**
 * Convenience accessor: jce_biz( 'phone' ) instead of get_theme_mod( 'jce_phone' ).
 */
function jce_biz( $key, $default = '' ) {
	$value = get_theme_mod( 'jce_' . $key, $default );
	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Phone digits only, for tel: hrefs.
 */
function jce_tel( $key = 'phone' ) {
	return preg_replace( '/[^0-9+]/', '', jce_biz( $key ) );
}

/**
 * Emergency number falls back to the main line when no separate one is set.
 */
function jce_emergency_phone() {
	$emergency = jce_biz( 'emergency_phone' );
	return $emergency ? $emergency : jce_biz( 'phone' );
}

function jce_emergency_tel() {
	return preg_replace( '/[^0-9+]/', '', jce_emergency_phone() );
}

/**
 * Resolve a Customizer URL setting that may be a path or a full URL.
 */
function jce_url( $key, $default = '/' ) {
	$value = jce_biz( $key, $default );
	if ( preg_match( '#^https?://#i', $value ) ) {
		return $value;
	}
	return home_url( $value );
}
