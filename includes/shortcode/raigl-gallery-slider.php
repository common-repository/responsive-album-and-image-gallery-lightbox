<?php
/**
 * 'raigl-gallery-slider' Shortcode 
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function raigl_gallery_slider( $atts, $content = null ) {          
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'id'				=> array(),
		'grid'    			=> '3',
		'design' 			=> 'design-1',
		'link_target'		=> 'self',
		'gallery_height'	=> '',
		'show_title'		=> 'false',
		'show_description'	=> 'false',
		'show_caption'		=> 'true',
		'image_size'		=> 'full',
		'popup'				=> 'true',
		'slidestoshow' 		=> '3',
		'slidestoscroll' 	=> '1',
		'dots'     			=> 'true',
		'arrows'     		=> 'true',
		'autoplay'     		=> 'true',
		'autoplay_interval' => '3000',
		'speed'             => '300',
		), $atts));
	
	$shortcode_designs 	= raigl_designs();
	$post_ids			= !empty($id)						? explode(',', $id) 				: array();
	$grid 				= (!empty($grid) && $grid <= 12) 	? $grid 							: '3';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$link_target 		= ($link_target == 'blank') 		? '_blank' 							: '_self';
	$gallery_height		= !empty($gallery_height)			? $gallery_height 					: '';
	$height_css			= !empty($gallery_height)			? "height:{$gallery_height}px;"		: '';
	$show_title			= ($show_title == 'true')			? 'true'							: 'false';
	$show_description	= ($show_description == 'true')		? 'true'							: 'false';
	$show_caption		= ($show_caption == 'false')		? 'false'							: 'true';
	$popup				= ($popup == 'false')				? 'false'							: 'true';
	$image_size 		= !empty($image_size)				? $image_size						: $image_size;
	$slidestoshow 		= !empty($slidestoshow) 			? $slidestoshow 						: 3;
	$slidestoscroll 	= !empty($slidestoscroll) 			? $slidestoscroll 						: 1;
	$dots 				= ( $dots == 'false' ) 				? 'false' 								: 'true';
	$arrows 			= ( $arrows == 'false' ) 			? 'false' 								: 'true';
	$autoplay 			= ( $autoplay == 'false' ) 			? 'false' 								: 'true';
	$autoplay_interval 	= (!empty($autoplay_interval)) 		? $autoplay_interval 					: 3000;
	$speed 				= (!empty($speed)) 					? $speed 								: 300;

	// If no id is passed then return
	if( empty($post_ids) ) {
		return $content;
	}

	// Enqueue required script
	if( $popup == 'true' ) {
		wp_enqueue_script('raigl-magnific-script');
	}
	wp_enqueue_script('raigl-slick-jquery');
	wp_enqueue_script('raigl-public-js');

	// Shortcode file
	$design_file_path 	= RAIGL_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
	
	// Taking some global
	global $post;
	
	// Taking some variables
	$prefix 				= RAIGL_META_PREFIX;
	$unique					= raigl_get_unique();
	$wrpper_cls				= 'raigl-slider-slide raigl-cnt-wrp';
	$popup_cls 				= ($popup == 'true') ? 'raigl-popup-gallery' : '';
	$offset_css				= '';
	$loop_count				= 1;

	// Slider configuration
	$slider_conf = compact('slidestoshow', 'slidestoscroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed');

	// WP Query Parameters
	$args = array (
		'post_type'     	 	=> RAIGL_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'post__in'		 		=> $post_ids,
		'ignore_sticky_posts'	=> true,
	);

	// WP Query Parameters
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

	<div class="raigl-gallery-slider-wrp">
		<div class="raigl-gallery raigl-gallery-wrp raigl-gallery-slider raigl-clearfix raigl-<?php echo $design.' '.$popup_cls; ?>" id="raigl-gallery-<?php echo $unique; ?>">
		<?php while ( $query->have_posts() ) : $query->the_post();

				$gallery_imgs = get_post_meta( $post->ID, $prefix.'gallery_imgs', true );

				if( !empty($gallery_imgs) ) {
					foreach ($gallery_imgs as $img_key => $img_data) {
						
						$gallery_post		= get_post( $img_data );
						$gallery_img_src 	= raigl_get_image_src( $img_data, $image_size );
						$image_alt_text		= get_post_meta( $img_data, '_wp_attachment_image_alt', true );

						if( $popup == 'true' ) {
							$image_link	= raigl_get_image_src( $img_data, 'full' );
						} else {
							$image_link = get_post_meta( $img_data, $prefix.'attachment_link', true );
						}

						// Include shortcode html file
						if( $gallery_post && $design_file && $gallery_img_src ) {
							include( $design_file );

							$loop_count++; // Increment loop count
						}
					} // End of for each
				}

		endwhile;
		?>
		</div>
		<div class="raigl-gallery-slider-conf raigl-hide"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
	</div>

	<?php }

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'raigl-gallery-slider' shortcode
add_shortcode('raigl-gallery-slider', 'raigl_gallery_slider');