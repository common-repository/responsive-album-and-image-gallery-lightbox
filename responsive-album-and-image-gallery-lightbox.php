<?php
/**
 * Plugin Name: Responsive Album and Image Gallery Lightbox
 * Description: Easy to add Album and display image in gallery with slider.
 * Author: WP Online Help
 * Text Domain: album-and-image-gallery-lightbox
 * Domain Path: /languages/
 * Version: 2.0
 * Author URI:http://www.wponlinehelp.com/
 * Contributors:WP Online Help
 *
 * @package WordPress
 */
/**
 * Basic plugin definitions
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
if( !defined( 'RAIGL_VERSION' ) ) {
	define( 'RAIGL_VERSION', '2.0' ); // Version of plugin
}
if( !defined( 'RAIGL_DIR' ) ) {
    define( 'RAIGL_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'RAIGL_URL' ) ) {
    define( 'RAIGL_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'RAIGL_PLUGIN_BASENAME' ) ) {
	define( 'RAIGL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'RAIGL_POST_TYPE' ) ) {
    define( 'RAIGL_POST_TYPE', 'raigl_gallery' ); // Plugin post type
}
if( !defined( 'RAIGL_CAT' ) ) {
    define( 'RAIGL_CAT', 'raigl_cat' ); // Plugin category name
}
if( !defined( 'RAIGL_META_PREFIX' ) ) {
    define( 'RAIGL_META_PREFIX', '_raigl_' ); // Plugin metabox prefix
}
/**
 * Load Text Domain
 * This  plugin ready for translation
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_load_textdomain() {
	load_plugin_textdomain( 'album-and-image-gallery-lightbox', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'raigl_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'raigl_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'raigl_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_install() {
    
    // Register post type function
    raigl_register_post_type();
    raigl_register_taxonomies();
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

// Taking some globals
global $raigl_gallery_render;

// Functions file
require_once( RAIGL_DIR . '/includes/raigl-functions.php' );

// Plugin Post Type File
require_once( RAIGL_DIR . '/includes/raigl-post-types.php' );

// Admin Class File
require_once( RAIGL_DIR . '/includes/admin/class-raigl-admin.php' );

// Script Class File
require_once( RAIGL_DIR . '/includes/class-raigl-script.php' );

// Shortcode File
require_once( RAIGL_DIR . '/includes/shortcode/raigl-gallery.php' );
require_once( RAIGL_DIR . '/includes/shortcode/raigl-gallery-slider.php' );
require_once( RAIGL_DIR . '/includes/shortcode/raigl-gallery-album.php' );
require_once( RAIGL_DIR . '/includes/shortcode/raigl-gallery-album-slider.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( RAIGL_DIR . '/includes/admin/raigl-how-it-work.php' );
}