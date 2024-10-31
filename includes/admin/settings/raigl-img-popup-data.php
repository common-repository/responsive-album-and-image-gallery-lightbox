<?php
/**
 * Popup Image Data HTML
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$prefix = RAIGL_META_PREFIX;

// Taking some values
$alt_text 			= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
$attachment_link 	= get_post_meta( $attachment_id, $prefix.'attachment_link', true );
?>

<div class="raigl-popup-title"><?php _e('Edit Image', 'album-and-image-gallery-lightbox'); ?></div>
	
<div class="raigl-popup-body">

	<form method="post" class="raigl-attachment-form">
		
		<?php if( !empty($attachment_post->guid) ) { ?>
		<div class="raigl-popup-img-preview">
			<img src="<?php echo $attachment_post->guid; ?>" alt="" />
		</div>
		<?php } ?>
		<a href="<?php echo get_edit_post_link( $attachment_id ); ?>" target="_blank" class="button right"><i class="dashicons dashicons-edit"></i> <?php _e('Edit Image From Attachment Page', 'album-and-image-gallery-lightbox'); ?></a>

		<table class="form-table">
			<tr>
				<th><label for="raigl-attachment-title"><?php _e('Title', 'album-and-image-gallery-lightbox'); ?>:</label></th>
				<td>
					<input type="text" name="raigl_attachment_title" value="<?php echo raigl_esc_attr($attachment_post->post_title); ?>" class="large-text raigl-attachment-title" id="raigl-attachment-title" />
					<span class="description"><?php _e('Enter image title.', 'album-and-image-gallery-lightbox'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="raigl-attachment-alt-text"><?php _e('Alternative Text', 'album-and-image-gallery-lightbox'); ?>:</label></th>
				<td>
					<input type="text" name="raigl_attachment_alt" value="<?php echo raigl_esc_attr($alt_text); ?>" class="large-text raigl-attachment-alt-text" id="raigl-attachment-alt-text" />
					<span class="description"><?php _e('Enter image alternative text.', 'album-and-image-gallery-lightbox'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="raigl-attachment-caption"><?php _e('Caption', 'album-and-image-gallery-lightbox'); ?>:</label></th>
				<td>
					<textarea name="raigl_attachment_caption" class="large-text raigl-attachment-caption" id="raigl-attachment-caption"><?php echo raigl_esc_attr($attachment_post->post_excerpt); ?></textarea>
					<span class="description"><?php _e('Enter image caption.', 'album-and-image-gallery-lightbox'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="raigl-attachment-desc"><?php _e('Description', 'album-and-image-gallery-lightbox'); ?>:</label></th>
				<td>
					<textarea name="raigl_attachment_desc" class="large-text raigl-attachment-desc" id="raigl-attachment-desc"><?php echo raigl_esc_attr($attachment_post->post_content); ?></textarea>
					<span class="description"><?php _e('Enter image description.', 'album-and-image-gallery-lightbox'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="raigl-attachment-link"><?php _e('Image Link', 'album-and-image-gallery-lightbox'); ?>:</label></th>
				<td>
					<input type="text" name="raigl_attachment_link" value="<?php echo esc_url($attachment_link); ?>" class="large-text raigl-attachment-link" id="raigl-attachment-link" />
					<span class="description"><?php _e('Enter image link. e.g http://google.com', 'album-and-image-gallery-lightbox'); ?></span>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="right">
					<div class="raigl-success raigl-hide"></div>
					<div class="raigl-error raigl-hide"></div>
					<span class="spinner raigl-spinner"></span>
					<button type="button" class="button button-primary raigl-save-attachment-data" data-id="<?php echo $attachment_id; ?>"><i class="dashicons dashicons-yes"></i> <?php _e('Save Changes', 'album-and-image-gallery-lightbox'); ?></button>
					<button type="button" class="button raigl-popup-close"><?php _e('Close', 'album-and-image-gallery-lightbox'); ?></button>
				</td>
			</tr>
		</table>
	</form><!-- end .raigl-attachment-form -->

</div><!-- end .raigl-popup-body -->