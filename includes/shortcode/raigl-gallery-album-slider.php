<?php
/**
 * 'raigl-gallery-album-slider' Shortcode
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function raigl_gallery_album_slider( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'				=> 15,
		'album_design' 		=> 'design-1',
		'album_link_target'	=> 'self',
		'album_height'		=> '',
		'album_title'		=> 'false',
		'album_description'	=> 'false',
		'album_full_content'=> 'false',
		'words_limit' 		=> 40,
		'content_tail' 		=> '...',
		'id'				=> array(),
		'category' 			=> '',
		'total_photo'		=> '{total}'.' '.__('Photos','album-and-image-gallery-lightbox'),

		'popup'				=> 'true',
		'grid'				=> '3',
		'gallery_height'	=> '',
		'design'			=> 'design-1',
		'show_caption'		=> 'true',
		'show_title'		=> 'false',
		'show_description'	=> 'false',
		'link_target'		=> 'self',
		'image_size'		=> 'full',

		'album_slidestoshow'		=> '3',
		'album_slidestoscroll' 		=> '1',
		'album_dots'     			=> 'true',
		'album_arrows'     			=> 'true',
		'album_autoplay'     		=> 'true',
		'album_autoplay_interval'	=> '3000',
		'album_speed'             	=> '300',
	), $atts));
	
	$album_designs 		= raigl_album_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$limit 				= !empty($limit) 					? $limit 							: 15;
	$post_ids			= !empty($id)						? explode(',', $id) 				: array();
	$album_design 		= ($album_design && (array_key_exists(trim($album_design), $album_designs))) ? trim($album_design) : 'design-1';
	$album_link_target 	= ($album_link_target == 'blank') 	? '_blank' 							: '_self';
	$album_title		= ($album_title == 'true')			? 'true'							: 'false';
	$album_description	= ($album_description == 'true')	? 'true'							: 'false';
	$album_full_content	= ($album_full_content == 'true')	? 'true'							: 'false';
	$category 			= (!empty($category))				? explode(',',$category) 			: '';
	$album_height		= !empty($album_height)				? $album_height 					: '';
	$album_height_css	= !empty($album_height)				? "height:{$album_height}px;"		: '';
	$total_photo 		= !empty($total_photo) 				? $total_photo						: '';

	$slidestoshow 		= !empty($album_slidestoshow) 			? $album_slidestoshow 		: 3;
	$slidestoscroll 	= !empty($album_slidestoscroll) 		? $album_slidestoscroll 	: 1;
	$dots 				= ( $album_dots == 'false' ) 			? 'false' 					: 'true';
	$arrows 			= ( $album_arrows == 'false' ) 			? 'false' 					: 'true';
	$autoplay 			= ( $album_autoplay == 'false' ) 		? 'false' 					: 'true';
	$autoplay_interval 	= (!empty($album_autoplay_interval)) 	? $album_autoplay_interval 	: 3000;
	$speed 				= (!empty($album_speed)) 				? $album_speed 				: 300;

	// Taking some global
	global $post, $raigl_gallery_render;

	// If album id passed and it is empty then return
	if( isset($_GET['album']) && (empty($_GET['album']) || !empty($raigl_gallery_render)) ) {
		return $content;
	} elseif ( isset($_GET['album']) && !empty($_GET['album']) ) {
		$post_ids = $_GET['album'];
	}

	// Enqueue required script
	wp_enqueue_script('raigl-magnific-script');
	wp_enqueue_script('raigl-slick-jquery');
	wp_enqueue_script('raigl-public-js');


	// Shortcode file
	$design_file_path 	= RAIGL_DIR . '/templates/album/' . $album_design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Taking some variables
	$prefix 			= RAIGL_META_PREFIX;
	$unique				= raigl_get_unique();
	$album_page 		= get_permalink();
	$loop_count			= 1;
	$wrpper_cls			= 'raigl-slider-slide raigl-cnt-wrp';

	// Slider configuration
	$slider_conf = compact('slidestoshow', 'slidestoscroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed');

	// If album id is not passed then take all albums else album images
	if( empty($_GET['album']) ) {

		// WP Query Parameters
		$args = array (
			'post_type'     	 	=> RAIGL_POST_TYPE,
			'post_status' 			=> array( 'publish' ),
			'post__in'		 		=> $post_ids,
			'ignore_sticky_posts'	=> true,
			'posts_per_page'		=> $limit,
			'order'					=> 'DESC',
			'orderby'				=> 'date',
		);

		// Meta Query
		$args['meta_query'] = array(
								array(
									'key'     => $prefix.'gallery_imgs',
									'value'   => '',
									'compare' => '!=',
								));

		// Category Parameter
		if( !empty($category) ) {

			$args['tax_query'] = array(
									array( 
										'taxonomy' 			=> RAIGL_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $category,
								));

		}

		// WP Query Parameters
		$raigl_query = new WP_Query($args);
	}
	
	ob_start();
	
	// If post is there
	if ( empty($_GET['album']) && $raigl_query->have_posts() ) { ?>
		
	<div class="raigl-gallery-slider-wrp">	
		<div class="raigl-gallery-album-wrp raigl-gallery-slider raigl-gallery-album-slider raigl-clearfix raigl-album-<?php echo $album_design; ?>" id="raigl-gallery-<?php echo $unique; ?>">
		<?php while ( $raigl_query->have_posts() ) : $raigl_query->the_post();
				
				$album_image 		= add_query_arg( array('album' => $post->ID), $album_page );
				$image_link			= raigl_get_image_src( get_post_thumbnail_id($post->ID), 'full', true );
				$total_photo_no		= get_post_meta($post->ID, $prefix.'gallery_imgs', true);
				$total_photo_no 	= !empty($total_photo_no) ? count($total_photo_no) : '';
				$total_photo_lbl	= str_replace('{total}', $total_photo_no, $total_photo);
				
				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}

				$loop_count++; // Increment loop count
		endwhile;
		?>
		</div>
		<div class="raigl-gallery-slider-conf raigl-hide"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
	</div>

	<?php
		wp_reset_query(); // Reset WP Query

	} elseif( !empty($_GET['album']) ) { // If album id is passed
			
			// If there are two shortcodes so display for first only
			$raigl_gallery_render = true;
			
			echo "<div class='raigl-breadcrumb-wrp'><a class='raigl-breadcrumb' href='{$album_page}'>".__('Main Album', 'album-and-image-gallery-lightbox')."</a> &raquo; ".get_the_title($post_ids)."</div>";

			echo do_shortcode( '[raigl-gallery id="'.$post_ids.'" grid="'.$grid.'" gallery_height="'.$gallery_height.'" show_title="'.$show_title.'" show_description="'.$show_description.'" popup="'.$popup.'" link_target="'.$link_target.'" design="'.$design.'" image_size="'.$image_size.'"]' );

	} // end else
	
	$content .= ob_get_clean();
	return $content;
}

// 'raigl-gallery-album-slider' shortcode
add_shortcode('raigl-gallery-album-slider', 'raigl_gallery_album_slider');