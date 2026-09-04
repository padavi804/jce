<?php
/**
 * JCE Tree Service theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'JCE_THEME_VERSION', '0.2.0' );
define( 'JCE_THEME_DIR', get_template_directory() );
define( 'JCE_THEME_URI', get_template_directory_uri() );

require JCE_THEME_DIR . '/inc/theme-setup.php';
require JCE_THEME_DIR . '/inc/customizer.php';
require JCE_THEME_DIR . '/inc/icons.php';
require JCE_THEME_DIR . '/inc/media.php';
require JCE_THEME_DIR . '/inc/custom-post-types.php';
require JCE_THEME_DIR . '/inc/fields.php';
require JCE_THEME_DIR . '/inc/meta-boxes.php';
require JCE_THEME_DIR . '/inc/schema.php';
require JCE_THEME_DIR . '/inc/seo.php';
require JCE_THEME_DIR . '/inc/demo-content.php';
