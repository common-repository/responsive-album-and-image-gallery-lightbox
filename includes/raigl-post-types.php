<?php
/**
 * Register Post type functionality
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_register_post_type() {

	$raigl_post_lbls = apply_filters( 'raigl_post_labels', array(
								'name'                 	=> __('Album Gallery', 'album-and-image-gallery-lightbox'),
								'singular_name'        	=> __('Album Gallery', 'album-and-image-gallery-lightbox'),
								'add_new'              	=> __('Add Album Gallery', 'album-and-image-gallery-lightbox'),
								'add_new_item'         	=> __('Add New Album Gallery', 'album-and-image-gallery-lightbox'),
								'edit_item'            	=> __('Edit Album Gallery', 'album-and-image-gallery-lightbox'),
								'new_item'             	=> __('New Album Gallery', 'album-and-image-gallery-lightbox'),
								'view_item'            	=> __('View Album Gallery', 'album-and-image-gallery-lightbox'),
								'search_items'         	=> __('Search Album Gallery', 'album-and-image-gallery-lightbox'),
								'not_found'            	=> __('No Album Gallery Found', 'album-and-image-gallery-lightbox'),
								'not_found_in_trash'   	=> __('No Album Gallery Found in Trash', 'album-and-image-gallery-lightbox'),
								'parent_item_colon'    	=> '',
								'featured_image'		=> __('Album Image', 'album-and-image-gallery-lightbox'),
								'set_featured_image'	=> __('Set Album Image', 'album-and-image-gallery-lightbox'),
								'remove_featured_image'	=> __('Remove Album Image', 'album-and-image-gallery-lightbox'),
								'menu_name'           	=> __('All Album Gallery', 'album-and-image-gallery-lightbox')
							));

	$raigl_slider_args = array(
		'labels'				=> $raigl_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-format-gallery',
		'supports'            	=> apply_filters('raigl_post_supports', array('title', 'editor', 'thumbnail')),
	);

	// Register slick slider post type
	register_post_type( RAIGL_POST_TYPE, apply_filters( 'raigl_registered_post_type_args', $raigl_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'raigl_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_register_taxonomies() {

	$raigl_cat_lbls = apply_filters('raigl_cat_labels', array(
		'name'              => __( 'Category', 'album-and-image-gallery-lightbox' ),
		'singular_name'     => __( 'Category', 'album-and-image-gallery-lightbox' ),
		'search_items'      => __( 'Search Category', 'album-and-image-gallery-lightbox' ),
		'all_items'         => __( 'All Category', 'album-and-image-gallery-lightbox' ),
		'parent_item'       => __( 'Parent Category', 'album-and-image-gallery-lightbox' ),
		'parent_item_colon' => __( 'Parent Category:', 'album-and-image-gallery-lightbox' ),
		'edit_item'         => __( 'Edit Category', 'album-and-image-gallery-lightbox' ),
		'update_item'       => __( 'Update Category', 'album-and-image-gallery-lightbox' ),
		'add_new_item'      => __( 'Add New Category', 'album-and-image-gallery-lightbox' ),
		'new_item_name'     => __( 'New Category Name', 'album-and-image-gallery-lightbox' ),
		'menu_name'         => __( 'Category', 'album-and-image-gallery-lightbox' ),
	));

    $raigl_cat_args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $raigl_cat_lbls,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );
    
    // Register slick slider category
    register_taxonomy( RAIGL_CAT, array( RAIGL_POST_TYPE ), apply_filters('raigl_registered_cat_args', $raigl_cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'raigl_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[RAIGL_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Album Gallery updated.', 'album-and-image-gallery-lightbox' ) ),
		2 => __( 'Custom field updated.', 'album-and-image-gallery-lightbox' ),
		3 => __( 'Custom field deleted.', 'album-and-image-gallery-lightbox' ),
		4 => __( 'Album Gallery updated.', 'album-and-image-gallery-lightbox' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Album Gallery restored to revision from %s', 'album-and-image-gallery-lightbox' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Album Gallery published.', 'album-and-image-gallery-lightbox' ) ),
		7 => __( 'Album Gallery saved.', 'album-and-image-gallery-lightbox' ),
		8 => sprintf( __( 'Album Gallery submitted.', 'album-and-image-gallery-lightbox' ) ),
		9 => sprintf( __( 'Album Gallery scheduled for: <strong>%1$s</strong>.', 'album-and-image-gallery-lightbox' ),
		  date_i18n( __( 'M j, Y @ G:i', 'album-and-image-gallery-lightbox' ), strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Album Gallery draft updated.', 'album-and-image-gallery-lightbox' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'raigl_post_updated_messages' );