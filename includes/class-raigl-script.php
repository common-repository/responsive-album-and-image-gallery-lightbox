<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Raigl_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'raigl_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'raigl_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'raigl_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'raigl_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_front_style() {

		// Registring and enqueing magnific css
		if( !wp_style_is( 'raigl-magnific-style', 'registered' ) ) {
			wp_register_style( 'raigl-magnific-style', RAIGL_URL.'assets/css/magnific-popup.css', array(), RAIGL_VERSION );
			wp_enqueue_style( 'raigl-magnific-style');
		}

		// Registring and enqueing slick css
		if( !wp_style_is( 'raigl-slick-style', 'registered' ) ) {
			wp_register_style( 'raigl-slick-style', RAIGL_URL.'assets/css/slick.css', array(), RAIGL_VERSION );
			wp_enqueue_style( 'raigl-slick-style');	
		}
		
		// Registring and enqueing public css
		wp_register_style( 'raigl-public-css', RAIGL_URL.'assets/css/raigl-public.css', null, RAIGL_VERSION );
		wp_enqueue_style( 'raigl-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_front_script() {

		// Registring magnific popup script
		if( !wp_script_is( 'raigl-magnific-script', 'registered' ) ) {
			
			wp_register_script( 'raigl-magnific-script', RAIGL_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), RAIGL_VERSION, true );
		}
		
		// Registring slick slider script
		if( !wp_script_is( 'raigl-slick-jquery', 'registered' ) ) {
			wp_register_script( 'raigl-slick-jquery', RAIGL_URL.'assets/js/slick.min.js', array('jquery'), RAIGL_VERSION, true );
		}

		// Registring public script
		wp_register_script( 'raigl-public-js', RAIGL_URL.'assets/js/raigl-public.js', array('jquery'), RAIGL_VERSION, true );
		wp_localize_script( 'raigl-public-js', 'Raigl', array(
															'is_mobile' 		=>	(wp_is_mobile()) 	? 1 : 0,
															'is_rtl' 			=>	(is_rtl()) 			? 1 : 0,
														));
	}
	
	/**
	 * Enqueue admin styles
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_admin_style( $hook ) {

		global $typenow;
		
		// If page is plugin setting page then enqueue script
		if( $typenow == RAIGL_POST_TYPE ) {
			
			// Registring admin script
			wp_register_style( 'raigl-admin-style', RAIGL_URL.'assets/css/raigl-admin.css', null, RAIGL_VERSION );
			wp_enqueue_style( 'raigl-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_admin_script( $hook ) {

		global $wp_version, $wp_query, $typenow;
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		if( $typenow == RAIGL_POST_TYPE ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring admin script
			wp_register_script( 'raigl-admin-script', RAIGL_URL.'assets/js/raigl-admin.js', array('jquery'), RAIGL_VERSION, true );
			wp_localize_script( 'raigl-admin-script', 'RaiglAdmin', array(
																	'new_ui' 				=>	$new_ui,
																	'img_edit_popup_text'	=> __('Edit Image in Popup', 'album-and-image-gallery-lightbox'),
																	'attachment_edit_text'	=> __('Edit Image', 'album-and-image-gallery-lightbox'),
																	'img_delete_text'		=> __('Remove Image', 'album-and-image-gallery-lightbox'),
																));
			wp_enqueue_script( 'raigl-admin-script' );
			wp_enqueue_media(); // For media uploader
		}
	}
}

$raigl_script = new Raigl_Script();