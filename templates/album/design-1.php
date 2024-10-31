<?php
/**
 * Album Design 1 HTML
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="<?php echo $wrpper_cls; ?>">
	<div class="raigl-inr-wrp">
		
		<div class="raigl-img-wrp" style="<?php echo $album_height_css; ?>">
			<a class="raigl-img-link" href="<?php echo $album_image; ?>" target="<?php echo $album_link_target; ?>">
				<?php if($image_link) { ?>
				<img class="raigl-img" src="<?php echo $image_link; ?>" title="<?php echo $post->post_title; ?>" alt="<?php _e('Album Image', 'album-and-image-gallery-lightbox'); ?>" />
				<?php } ?>
			</a>
		</div><!-- end .raigl-img-wrp -->
		
		<?php if( $album_title == 'true' ) { ?>
		<div class="raigl-img-title raigl-center"><?php echo $post->post_title; ?></div>
		<?php } ?>
		
		<?php if( !empty($total_photo_lbl) ) { ?>
		<div class="raigl-img-count raigl-center"><?php echo $total_photo_lbl; ?></div>
		<?php } ?>
		
		<?php if( $album_description == 'true' ) {
				if( $album_full_content == 'true' ) { ?>
					<div class="raigl-img-desc raigl-center"><?php echo wpautop($post->post_content); ?></div>
		<?php } else { ?>
					<div class="raigl-img-desc raigl-center"><?php echo raigl_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
		<?php } } ?>
		
	</div><!-- end .raigl-inr-wrp -->
</div><!-- end .raigl-columns -->