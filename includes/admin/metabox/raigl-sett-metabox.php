<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = RAIGL_META_PREFIX; // Metabox prefix

$gallery_imgs 	= get_post_meta( $post->ID, $prefix.'gallery_imgs', true );
$no_img_cls		= !empty($gallery_imgs) ? 'raigl-hide' : '';
?>

<table class="form-table raigl-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="raigl-gallery-imgs"><?php _e('Choose Gallery Images', 'album-and-image-gallery-lightbox'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary raigl-img-uploader" id="raigl-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'album-and-image-gallery-lightbox'); ?>" data-title="<?php _e('Add Images to Gallery', 'album-and-image-gallery-lightbox'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'album-and-image-gallery-lightbox'); ?></button>
				<button type="button" class="button button-secondary raigl-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'album-and-image-gallery-lightbox'); ?></button><br/>
				
				<div class="raigl-gallery-imgs-prev raigl-imgs-preview raigl-gallery-imgs-wrp">
					<?php if( !empty($gallery_imgs) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="raigl-img-wrp">
								<div class="raigl-img-tools raigl-hide">
									<span class="raigl-tool-icon raigl-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'album-and-image-gallery-lightbox'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php _e('Edit Image', 'album-and-image-gallery-lightbox'); ?>"><span class="raigl-tool-icon raigl-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="raigl-tool-icon raigl-del-tool raigl-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'album-and-image-gallery-lightbox'); ?>"></span>
								</div>
								<img class="raigl-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="raigl-attachment-no" name="raigl_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .raigl-img-wrp -->
					<?php }
					} ?>
					
					<p class="raigl-img-placeholder <?php echo $no_img_cls; ?>"><?php _e('No Gallery Images', 'album-and-image-gallery-lightbox'); ?></p>

				</div><!-- end .raigl-imgs-preview -->
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'album-and-image-gallery-lightbox'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .raigl-post-sett-table -->