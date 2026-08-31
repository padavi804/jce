<?php
/**
 * Inline SVG icons.
 *
 * Inlined rather than loaded as an icon font or sprite sheet: zero extra HTTP
 * requests, no render-blocking, no FOUT — which matters for the Core Web Vitals
 * side of the SEO goal. Icons inherit currentColor and are hidden from
 * screen readers (they're always paired with visible text).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jce_icon_paths( $name ) {
	$icons = array(
		'phone'      => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'       => '<path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22,6 12,13 2,6"/>',
		'clock'      => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'map-pin'    => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
		'check'      => '<polyline points="20 6 9 17 4 12"/>',
		'check-circle' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
		'arrow-right'=> '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
		'star'       => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
		'shield'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
		'award'      => '<circle cx="12" cy="8" r="6"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
		'users'      => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'truck'      => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
		'leaf'       => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/>',
		'tree'       => '<path d="M12 2 6.5 10h3L5 17h14l-4.5-7h3L12 2z"/><line x1="12" y1="17" x2="12" y2="22"/>',
		'scissors'   => '<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/>',
		'zap'        => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
		'alert'      => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
		'search'     => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
		'layers'     => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
		'wind'       => '<path d="M9.59 4.59A2 2 0 1 1 11 8H2"/><path d="M12.59 19.41A2 2 0 1 0 14 16H2"/><path d="M17.73 7.73A2.5 2.5 0 1 1 19.5 12H2"/>',
		'disc'       => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/>',
		'clipboard'  => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1"/>',
		'droplet'    => '<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>',
		'calendar'   => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
		'chevron-down' => '<polyline points="6 9 12 15 18 9"/>',
		'facebook'   => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram'  => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Echo an inline SVG icon.
 *
 * @param string $name  Icon key from jce_icon_paths().
 * @param string $class Extra CSS classes.
 */
function jce_icon( $name, $class = '' ) {
	$paths = jce_icon_paths( $name );
	if ( ! $paths ) {
		return;
	}
	printf(
		'<svg class="icon %s" viewBox="0 0 24 24" aria-hidden="true" focusable="false">%s</svg>',
		esc_attr( $class ),
		$paths // phpcs:ignore WordPress.Security.EscapeOutput -- hardcoded SVG path data.
	);
}

/**
 * Decorative tree mark used inside image placeholders.
 */
function jce_placeholder_mark() {
	echo '<svg viewBox="0 0 64 72" aria-hidden="true" focusable="false" fill="currentColor"><path d="M32 4 18 26h7L12 46h16v22h8V46h16L39 26h7L32 4z"/></svg>';
}

/**
 * Media placeholder — stands in until real JCE photography is uploaded.
 *
 * @param string $modifier Extra class, e.g. 'media-ph--wide'.
 * @param string $label    Optional caption describing the intended photo.
 */
function jce_media_placeholder( $modifier = '', $label = '' ) {
	echo '<div class="media-ph ' . esc_attr( $modifier ) . '">';
	jce_placeholder_mark();
	if ( $label ) {
		echo '<span class="media-ph__label">' . esc_html( $label ) . '</span>';
	}
	echo '</div>';
}

/**
 * Featured image with a graceful placeholder fallback.
 */
function jce_image_or_placeholder( $post_id = null, $size = 'large', $modifier = '', $label = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, $size, array( 'loading' => 'lazy', 'decoding' => 'async' ) );
		return;
	}
	jce_media_placeholder( $modifier, $label );
}
