<?php
/**
 * Design 1 HTML
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="<?php echo $wrpper_cls; ?>">
	<div class="raigl-inr-wrp">

		<div class="raigl-img-wrp" style="<?php echo $height_css; ?>">
			<?php if($image_link) { ?>
			<a class="raigl-img-link" href="<?php echo $image_link; ?>" target="<?php echo $link_target; ?>">
				<img class="raigl-img" src="<?php echo $gallery_img_src ?>" title="<?php echo $gallery_post->post_title; ?>" alt="<?php echo $image_alt_text; ?>" />
			</a>
			<?php } else { ?>
				<img class="raigl-img" src="<?php echo $gallery_img_src ?>" title="<?php echo $gallery_post->post_title; ?>" alt="<?php echo $image_alt_text; ?>" />
			<?php } ?>

			<?php if( $show_caption == 'true' && $gallery_post->post_excerpt ) { ?>
			<div class="raigl-img-caption">
				<?php echo $gallery_post->post_excerpt; ?>
			</div>
			<?php } ?>
		</div><!-- end .raigl-img-wrp -->
		
		<?php if( $show_title == 'true' ) { ?>
		<div class="raigl-img-title raigl-center"><?php echo $gallery_post->post_title; ?></div>
		<?php } ?>
		
		<?php if( $show_description == 'true' && !empty($gallery_post->post_content) ) { ?>
		<div class="raigl-img-desc raigl-center"><?php echo wpautop($gallery_post->post_content); ?></div>
		<?php } ?>
		
	</div><!-- end .raigl-inr-wrp -->
</div><!-- end .raigl-columns -->