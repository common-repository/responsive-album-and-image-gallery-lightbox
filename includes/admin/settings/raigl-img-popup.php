<?php
/**
 * Image Data Popup
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="raigl-img-data-wrp raigl-hide">
	<div class="raigl-img-data-cnt">

		<div class="raigl-img-cnt-block">
			<div class="raigl-popup-close raigl-popup-close-wrp"><img src="<?php echo RAIGL_URL; ?>assets/images/close.png" alt="<?php _e('Close (Esc)', 'album-and-image-gallery-lightbox'); ?>" title="<?php _e('Close (Esc)', 'album-and-image-gallery-lightbox'); ?>" /></div>

			<div class="raigl-popup-body-wrp">
			</div><!-- end .raigl-popup-body-wrp -->
			
			<div class="raigl-img-loader"><?php _e('Please Wait', 'album-and-image-gallery-lightbox'); ?> <span class="spinner"></span></div>

		</div><!-- end .raigl-img-cnt-block -->

	</div><!-- end .raigl-img-data-cnt -->
</div><!-- end .raigl-img-data-wrp -->
<div class="raigl-popup-overlay"></div>