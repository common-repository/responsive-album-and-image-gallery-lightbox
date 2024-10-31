<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Raigl_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'raigl_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'raigl_save_metabox_value') );

		// Filter to add extra column in gallery `category` table
		add_filter( 'manage_edit-'.RAIGL_CAT.'_columns', array($this, 'raigl_manage_category_columns') );
		add_filter( 'manage_'.RAIGL_CAT.'_custom_column', array($this, 'raigl_category_data'), 10, 3 );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.RAIGL_POST_TYPE.'_posts_columns', array($this, 'raigl_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.RAIGL_POST_TYPE.'_posts_custom_column', array($this, 'raigl_post_columns_data'), 10, 2);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'raigl_add_post_row_data'), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'raigl_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_raigl_get_attachment_edit_form', array($this, 'raigl_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_raigl_get_attachment_edit_form',array( $this, 'raigl_get_attachment_edit_form'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_raigl_save_attachment_data', array($this, 'raigl_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_raigl_save_attachment_data',array( $this, 'raigl_save_attachment_data'));
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_post_sett_metabox() {
		add_meta_box( 'raigl-post-sett', __( 'Responsive Album and Image Gallery Lightbox - Settings', 'album-and-image-gallery-lightbox' ), array($this, 'raigl_post_sett_mb_content'), RAIGL_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_post_sett_mb_content() {
		include_once( RAIGL_DIR .'/includes/admin/metabox/raigl-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  RAIGL_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = RAIGL_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$gallery_imgs = isset($_POST['raigl_img']) ? raigl_slashes_deep($_POST['raigl_img']) : '';
		
		update_post_meta($post_id, $prefix.'gallery_imgs', $gallery_imgs);
	}
	
	/**
	 * Add extra column to news category
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_manage_category_columns($columns) {

		$new_columns['raigl_shortcode'] = __( 'Category Shortcode', 'album-and-image-gallery-lightbox' );

		$columns = raigl_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'raigl_shortcode' ) {
			$ouput .= '[raigl-gallery-album category="' . $tax_id. '"]<br/>';
			$ouput .= '[raigl-gallery-album-slider category="' . $tax_id. '"]';
	    }
		
	    return $ouput;
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_posts_columns( $columns ) {

	    $new_columns['raigl_shortcode'] 	= __('Shortcode', 'album-and-image-gallery-lightbox');
	    $new_columns['raigl_photos'] 		= __('Number of Photos', 'album-and-image-gallery-lightbox');

	    $columns = raigl_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_post_columns_data( $column, $post_id ) {

		global $post;

		// Taking some variables
		$prefix = RAIGL_META_PREFIX;

	    switch ($column) {
	    	case 'raigl_shortcode':
	    		
	    		echo '<div class="raigl-shortcode-preview">[raigl-gallery id="'.$post_id.'"]</div> <br/>';
	    		echo '<div class="raigl-shortcode-preview">[raigl-gallery-slider id="'.$post_id.'"]</div>';
	    		break;

	    	case 'raigl_photos':
	    		$total_photos = get_post_meta($post_id, $prefix.'gallery_imgs', true);
	    		echo !empty($total_photos) ? count($total_photos) : '--';
	    		break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == RAIGL_POST_TYPE ) {
			return array_merge( array( 'raigl_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_image_update_popup_html() {

		global $typenow;

		if( $typenow == RAIGL_POST_TYPE ) {
			include_once( RAIGL_DIR .'/includes/admin/settings/raigl-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_get_attachment_edit_form() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'album-and-image-gallery-lightbox');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';

		if( !empty($attachment_id) ) {
			$attachment_post = get_post( $_POST['attachment_id'] );

			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( RAIGL_DIR . '/includes/admin/settings/raigl-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'album-and-image-gallery-lightbox');
				$result['data']		= $attachment_data;
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Responsive Album and Image Gallery Lightbox
	 * @since 1.0.0
	 */
	function raigl_save_attachment_data() {

		$prefix 			= RAIGL_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'album-and-image-gallery-lightbox');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$raigl_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($raigl_attachment_post->post_type) && $raigl_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['raigl_attachment_title']) ? $form_data_arr['raigl_attachment_title'] : $raigl_attachment_post->post_name,
									'post_content'	=> $form_data_arr['raigl_attachment_desc'],
									'post_excerpt'	=> $form_data_arr['raigl_attachment_caption'],
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', raigl_slashes_deep($form_data_arr['raigl_attachment_alt']) );
					update_post_meta( $attachment_id, $prefix.'attachment_link', raigl_slashes_deep($form_data_arr['raigl_attachment_link']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'album-and-image-gallery-lightbox');
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}

$raigl_admin = new Raigl_Admin();