<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LocalBusiness schema, output site-wide (includes recent Review entries
 * so Review schema is present on every page, per the creative brief).
 */
function jce_business_schema() {
	$address = array(
		'@type'           => 'PostalAddress',
		'streetAddress'   => jce_biz( 'street_address' ),
		'addressLocality' => jce_biz( 'city', 'River Falls' ),
		'addressRegion'   => jce_biz( 'state', 'WI' ),
		'postalCode'      => jce_biz( 'zip' ),
		'addressCountry'  => 'US',
	);

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'LocalBusiness',
		'name'       => 'JCE Tree Service',
		'url'        => home_url( '/' ),
		'telephone'  => jce_biz( 'phone' ),
		'address'    => $address,
		'areaServed' => array( 'River Falls, WI', 'Hudson, WI', 'Prescott, WI' ),
		'priceRange' => '$$',
	);

	if ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$logo    = wp_get_attachment_image_src( $logo_id, 'full' );
		if ( $logo ) {
			$schema['logo']  = $logo[0];
			$schema['image'] = $logo[0];
		}
	}

	$rating = jce_biz( 'aggregate_rating' );
	$count  = jce_biz( 'review_count' );
	if ( $rating && $count ) {
		$schema['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $rating,
			'reviewCount' => $count,
		);
	}

	$same_as = array_filter(
		array(
			jce_biz( 'facebook_url' ),
			jce_biz( 'instagram_url' ),
			jce_biz( 'google_review_url' ),
		)
	);
	if ( $same_as ) {
		$schema['sameAs'] = array_values( $same_as );
	}

	$reviews = get_posts(
		array(
			'post_type'      => 'testimonial',
			'posts_per_page' => 5,
			'no_found_rows'  => true,
		)
	);
	if ( $reviews ) {
		$schema['review'] = array();
		foreach ( $reviews as $review ) {
			$review_rating       = get_post_meta( $review->ID, '_jce_rating', true );
			$schema['review'][] = array(
				'@type'        => 'Review',
				'author'       => array(
					'@type' => 'Person',
					'name'  => get_the_title( $review ),
				),
				'reviewBody'   => wp_strip_all_tags( $review->post_content ),
				'reviewRating' => array(
					'@type'       => 'Rating',
					'ratingValue' => $review_rating ? $review_rating : '5',
				),
			);
		}
	}

	return $schema;
}

/**
 * Service schema, output on single Service pages.
 */
function jce_service_schema() {
	if ( ! is_singular( 'service' ) ) {
		return null;
	}

	return array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'serviceType' => get_the_title(),
		'description' => wp_strip_all_tags( get_the_excerpt() ),
		'areaServed'  => array( 'River Falls, WI', 'Hudson, WI', 'Prescott, WI' ),
		'provider'    => array(
			'@type' => 'LocalBusiness',
			'name'  => 'JCE Tree Service',
			'url'   => home_url( '/' ),
		),
	);
}

function jce_output_schema() {
	$blocks = array_filter( array( jce_business_schema(), jce_service_schema() ) );
	foreach ( $blocks as $block ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $block ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'jce_output_schema' );
