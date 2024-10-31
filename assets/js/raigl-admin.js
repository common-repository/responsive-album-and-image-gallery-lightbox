jQuery(document).ready(function ($) {
    /*shortcode generator pre call function*/
    shortcodegenerategallery();
    shortcodegenerategallerysldr();
    shortcodegenerategalleryalbum();
    shortcodegenerategalleryalbumsldr();

    // Media Uploader
    $(document).on('click', '.raigl-img-uploader', function () {

        var imgfield, showfield;
        imgfield = jQuery(this).prev('input').attr('id');
        showfield = jQuery(this).parents('td').find('.raigl-imgs-preview');
        var multiple_img = jQuery(this).attr('data-multiple');
        multiple_img = (typeof (multiple_img) != 'undefined' && multiple_img == 'true') ? true : false;

        if (typeof wp == "undefined" || RaiglAdmin.new_ui != '1') { // check for media uploader

            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

            window.original_send_to_editor = window.send_to_editor;
            window.send_to_editor = function (html) {

                if (imgfield) {

                    var mediaurl = $('img', html).attr('src');
                    $('#' + imgfield).val(mediaurl);
                    showfield.html('<img src="' + mediaurl + '" />');
                    tb_remove();
                    imgfield = '';

                } else {
                    window.original_send_to_editor(html);
                }
            };
            return false;

        } else {

            var file_frame;
            //window.formfield = '';

            //new media uploader
            var button = jQuery(this);

            // If the media frame already exists, reopen it.
            if (file_frame) {
                file_frame.open();
                return;
            }

            if (multiple_img == true) {

                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: button.data('title'),
                    button: {
                        text: button.data('button-text'),
                    },
                    multiple: true  // Set to true to allow multiple files to be selected
                });

            } else {

                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    frame: 'post',
                    state: 'insert',
                    title: button.data('title'),
                    button: {
                        text: button.data('button-text'),
                    },
                    multiple: false  // Set to true to allow multiple files to be selected
                });
            }

            file_frame.on('menu:render:default', function (view) {
                // Store our views in an object.
                var views = {};

                // Unset default menu items
                view.unset('library-separator');
                view.unset('gallery');
                view.unset('featured-image');
                view.unset('embed');

                // Initialize the views in our view object.
                view.set(views);
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function () {

                // Get selected size from media uploader
                var selected_size = $('.attachment-display-settings .size').val();
                var selection = file_frame.state().get('selection');

                selection.each(function (attachment, index) {

                    attachment = attachment.toJSON();

                    // Selected attachment url from media uploader
                    var attachment_id = attachment.id ? attachment.id : '';
                    if (attachment_id && attachment.sizes && multiple_img == true) {

                        var attachment_url = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                        var attachment_edit_link = attachment.editLink ? attachment.editLink : '';

                        showfield.append('\
							<div class="raigl-img-wrp">\
								<div class="raigl-img-tools raigl-hide">\
									<span class="raigl-tool-icon raigl-edit-img dashicons dashicons-edit" title="' + RaiglAdmin.img_edit_popup_text + '"></span>\
									<a href="' + attachment_edit_link + '" target="_blank" title="' + RaiglAdmin.attachment_edit_text + '"><span class="raigl-tool-icon raigl-edit-attachment dashicons dashicons-visibility"></span></a>\
									<span class="raigl-tool-icon raigl-del-tool raigl-del-img dashicons dashicons-no" title="' + RaiglAdmin.img_delete_text + '"></span>\
								</div>\
								<img class="raigl-img" src="' + attachment_url + '" alt="" />\
								<input type="hidden" class="raigl-attachment-no" name="raigl_img[]" value="' + attachment_id + '" />\
							</div>\
								');
                        showfield.find('.raigl-img-placeholder').hide();
                    }
                });
            });

            // When an image is selected, run a callback.
            file_frame.on('insert', function () {

                // Get selected size from media uploader
                var selected_size = $('.attachment-display-settings .size').val();

                var selection = file_frame.state().get('selection');
                selection.each(function (attachment, index) {
                    attachment = attachment.toJSON();

                    // Selected attachment url from media uploader
                    var attachment_url = attachment.sizes[selected_size].url;

                    // place first attachment in field
                    $('#' + imgfield).val(attachment_url);
                    showfield.html('<img src="' + attachment_url + '" />');
                });
            });

            // Finally, open the modal
            file_frame.open();
        }
    });

    // Remove Single Gallery Image
    $(document).on('click', '.raigl-del-img', function () {

        $(this).closest('.raigl-img-wrp').fadeOut(300, function () {
            $(this).remove();

            if ($('.raigl-img-wrp').length == 0) {
                $('.raigl-img-placeholder').show();
            }
        });
    });

    // Remove All Gallery Image
    $(document).on('click', '.raigl-del-gallery-imgs', function () {

        var ans = confirm('Are you sure to remove all images from this gallery!');

        if (ans) {
            $('.raigl-gallery-imgs-wrp .raigl-img-wrp').remove();
            $('.raigl-img-placeholder').fadeIn();
        }
    });

    // Image ordering (Drag and Drop)
    $('.raigl-gallery-imgs-wrp').sortable({
        items: '.raigl-img-wrp',
        cursor: 'move',
        scrollSensitivity: 40,
        forcePlaceholderSize: true,
        forceHelperSize: false,
        helper: 'clone',
        opacity: 0.8,
        placeholder: 'raigl-gallery-placeholder',
        containment: '.raigl-post-sett-table',
        start: function (event, ui) {
            ui.item.css('background-color', '#f6f6f6');
        },
        stop: function (event, ui) {
            ui.item.removeAttr('style');
        }
    });

    // Open Attachment Data Popup
    $(document).on('click', '.raigl-img-wrp .raigl-edit-img', function () {

        $('.raigl-img-data-wrp').show();
        $('.raigl-popup-overlay').show();
        $('body').addClass('raigl-no-overflow');
        $('.raigl-img-loader').show();

        var current_obj = $(this);
        var attachment_id = current_obj.closest('.raigl-img-wrp').find('.raigl-attachment-no').val();

        var data = {
            action: 'raigl_get_attachment_edit_form',
            attachment_id: attachment_id
        };
        $.post(ajaxurl, data, function (response) {
            var result = $.parseJSON(response);

            if (result.success == 1) {
                $('.raigl-img-data-wrp  .raigl-popup-body-wrp').html(result.data);
                $('.raigl-img-loader').hide();
            }
        });
    });

    // Close Popup
    $(document).on('click', '.raigl-popup-close', function () {
        raigl_hide_popup();
    });

    // `Esc` key is pressed
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            raigl_hide_popup();
        }
    });

    // Save Attachment Data
    $(document).on('click', '.raigl-save-attachment-data', function () {
        var current_obj = $(this);
        current_obj.attr('disabled', 'disabled');
        current_obj.parent().find('.spinner').css('visibility', 'visible');

        var data = {
            action: 'raigl_save_attachment_data',
            attachment_id: current_obj.attr('data-id'),
            form_data: current_obj.closest('form.raigl-attachment-form').serialize()
        };
        $.post(ajaxurl, data, function (response) {
            var result = $.parseJSON(response);

            if (result.success == 1) {
                current_obj.closest('form').find('.raigl-success').html(result.msg).fadeIn().delay(3000).fadeOut();
            } else if (result.success == 0) {
                current_obj.closest('form').find('.raigl-error').html(result.msg).fadeIn().delay(3000).fadeOut();
            }
            current_obj.removeAttr('disabled', 'disabled');
            current_obj.parent().find('.spinner').css('visibility', '');
        });
    });
});

// Function to hide popup
function raigl_hide_popup() {
    jQuery('.raigl-img-data-wrp').hide();
    jQuery('.raigl-popup-overlay').hide();
    jQuery('body').removeClass('raigl-no-overflow');
    jQuery('.raigl-img-data-wrp  .raigl-popup-body-wrp').html('');
}

function shortcodegenerategallery() {
    var sg_main = "[raigl-gallery";
    var sg_album = jQuery('#gal_albums').val();
    var sg_grid = jQuery('#sg_grid').val();
    var sg_link_beh = jQuery('#sg_link_beh').val();
    var sg_gallery_height = jQuery('#sg_gallery_height').val();
    var sg_disp_title = jQuery('#sg_disp_title').val();
    var sg_img_size = jQuery('#sg_img_size').val();
    var sg_disp_desc = jQuery('#sg_disp_desc').val();
    var sg_disp_cap = jQuery('#sg_disp_cap').val();
    var sg_popup = jQuery('#sg_popup').val();
    
    sg_main = sg_main + ' id="' + sg_album + '"';
    sg_main = sg_main + ' grid="' + sg_grid + '"';
    sg_main = sg_main + ' link_target="' + sg_link_beh + '"';
    
    if (sg_gallery_height == '') {
        sg_main = sg_main + ' gallery_height="auto"';
    } else {
        sg_main = sg_main + ' gallery_height="' + sg_gallery_height + '"';
    }
    sg_main = sg_main + ' show_title="' + sg_disp_title + '"';
    sg_main = sg_main + ' image_size="' + sg_img_size + '"';
    sg_main = sg_main + ' show_description="' + sg_disp_desc + '"';
    sg_main = sg_main + ' show_caption="' + sg_disp_cap + '"';
    sg_main = sg_main + ' popup="' + sg_popup + '"';
    sg_main = sg_main + ']';
    jQuery("#shortcode").text(sg_main);
    jQuery("#gallery_shortcode_php").text("'"+sg_main+"'");
}

function shortcodegenerategallerysldr() {
    var sg_main = "[raigl-gallery-slider";    
    var sg_album = jQuery('#sldr_gal_albums').val();
    var sg_link_beh = jQuery('#sg_sldr_link_beh').val();
    var sg_gallery_height = jQuery('#sg_sldr_gallery_height').val();
    var sg_disp_title = jQuery('#sg_sldr_disp_title').val();
    var sg_img_size = jQuery('#sg_sldr_img_size').val();
    var sg_disp_desc = jQuery('#sg_sldr_disp_desc').val();
    var sg_disp_cap = jQuery('#sg_sldr_disp_cap').val();
    var sg_popup = jQuery('#sg_sldr_popup').val();
    var sg_cols = jQuery('#sg_sldr_cols').val();
    var sg_scr = jQuery('#sg_sldr_scr').val();
    var sg_dots = jQuery('#sg_pagi_dots').val();
    var sg_pagi_arr = jQuery('#sg_pagi_arr').val();
    var sg_autop = jQuery('#sg_sldr_autoplay').val();
    var sg_auto_int = jQuery('#sg_sldr_auto_int').val();
    var sg_speed = jQuery('#sg_sldr_speed').val();
    
    sg_main = sg_main + ' id="' + sg_album + '"';
    sg_main = sg_main + ' link_target="' + sg_link_beh + '"';
    
    if (sg_gallery_height == '') {
        sg_main = sg_main + ' gallery_height="auto"';
    } else {
        sg_main = sg_main + ' gallery_height="' + sg_gallery_height + '"';
    }
    sg_main = sg_main + ' show_title="' + sg_disp_title + '"';
    sg_main = sg_main + ' image_size="' + sg_img_size + '"';
    sg_main = sg_main + ' show_description="' + sg_disp_desc + '"';
    sg_main = sg_main + ' show_caption="' + sg_disp_cap + '"';
    sg_main = sg_main + ' popup="' + sg_popup + '"';
    sg_main = sg_main + ' slidestoshow="' + sg_cols + '"';
    sg_main = sg_main + ' slidestoscroll="' + sg_scr + '"';
    sg_main = sg_main + ' dots="' + sg_dots + '"';
    sg_main = sg_main + ' arrows="' + sg_pagi_arr + '"';
    sg_main = sg_main + ' autoplay="' + sg_autop + '"';
    sg_main = sg_main + ' autoplay_interval="' + sg_auto_int + '"';
    sg_main = sg_main + ' speed="' + sg_speed + '"';
    
    sg_main = sg_main + ']';
    jQuery("#shortcode_sldr").text(sg_main);
	jQuery("#gallery_slider_shortcode_php").text("'"+sg_main+"'");
}

function shortcodegenerategalleryalbum() {
 var sg_main = "[raigl-gallery-album";
 var sg_specific_album = jQuery('#sg_specific_albums').val();
 var sg_albums_category = jQuery('#sg_albums_category').val();
 var galleryalbum_limit = jQuery('#sg_galleryalbum_limit').val();
 var galleryalbum_album_grid = jQuery('#sg_galleryalbum_album_grid').val();
 var galleryalbum_album_link_beh = jQuery('#sg_galleryalbum_album_link_beh').val();
 var galleryalbum_album_height = jQuery('#sg_galleryalbum_album_height').val();
 var galleryalbum_title = jQuery('#sg_galleryalbum_title').val();
 var galleryalbum_description = jQuery('#sg_galleryalbum_description').val();
 var galleryalbum_fullcontent = jQuery('#sg_galleryalbum_fullcontent').val();
 var sg_galleryalbum_wordslimit = jQuery('#sg_galleryalbum_wordslimit').val();
 var sg_galleryalbum_popup = jQuery('#sg_galleryalbum_popup').val();
 var sg_galleryalbum_gallery_grid = jQuery('#sg_galleryalbum_gallery_grid').val();
 var sg_galleryalbum_height = jQuery('#sg_galleryalbum_height').val();
 var sg_galleryalbum_gallery_title = jQuery('#sg_galleryalbum_gallery_title').val();
 var sg_galleryalbum_gallery_caption = jQuery('#sg_galleryalbum_gallery_caption').val();
 var galleryalbum_gallery_link_beh = jQuery('#sg_galleryalbum_gallery_link_beh').val();
 var galleryalbum_gallery_description = jQuery('#sg_galleryalbum_gallery_description').val();
var sg_galleryalbum_img_size = jQuery('#sg_galleryalbum_img_size').val();
 if (sg_albums_category != 'All' && sg_albums_category != 'all') {sg_main = sg_main + ' category="' + sg_albums_category + '"';}
 if (sg_specific_album != '') { sg_main = sg_main + ' id="' + sg_specific_album + '"';} 
  
 sg_main = sg_main + ' limit="' + galleryalbum_limit + '"';
 sg_main = sg_main + ' album_grid="' + galleryalbum_album_grid + '"';
 sg_main = sg_main + ' album_link_target="' + galleryalbum_album_link_beh + '"';
 if (galleryalbum_album_height == '') {sg_main = sg_main + ' album_height="auto"';} 
 else { sg_main = sg_main + ' album_height="' + galleryalbum_album_height + '"';}
sg_main = sg_main + ' album_title="' + galleryalbum_title + '"';
sg_main = sg_main + ' album_description="' + galleryalbum_description + '"';
sg_main = sg_main + ' album_full_content="' + galleryalbum_fullcontent + '"';
if(sg_galleryalbum_wordslimit !=""){sg_main = sg_main + ' words_limit="' + sg_galleryalbum_wordslimit + '"';}
sg_main = sg_main + ' popup="' + sg_galleryalbum_popup + '"';
sg_main = sg_main + ' grid="' + sg_galleryalbum_gallery_grid + '"';
if (sg_galleryalbum_height == '') {sg_main = sg_main + ' gallery_height="auto"';} 
else {sg_main = sg_main + ' gallery_height="' + sg_galleryalbum_height + '"';}
sg_main = sg_main + 'show_title="' + sg_galleryalbum_gallery_title + '"';
sg_main = sg_main + 'show_caption="' + sg_galleryalbum_gallery_caption + '"';
sg_main = sg_main + 'link_target="' + galleryalbum_gallery_link_beh + '"';
sg_main = sg_main + 'show_description="' + galleryalbum_gallery_description + '"';
 sg_main = sg_main + ' image_size="' + sg_galleryalbum_img_size + '"';
 sg_main = sg_main + ']';
    jQuery("#shortcode_galleryalbum").text(sg_main);
    jQuery("#php_shortcode_galleryalbum").text("'"+sg_main+"'");
    }

function shortcodegenerategalleryalbumsldr() {
var sg_main = "[raigl-gallery-slider"; 

var sg_albums_sldr_specific_albums = jQuery('#sg_albums_sldr_specific_albums').val();
 var sg_albums_sldr_category = jQuery('#sg_albums_sldr_category').val();

 var sg_galleryalbumsldr_limit = jQuery('#sg_galleryalbumsldr_limit').val();
var galleryalbum_sldr_link_beh = jQuery('#sg_galleryalbum_sldr_link_beh').val();
var galleryalbum_sldr_height = jQuery('#sg_galleryalbum_sldr_height').val();
var sg_galleryalbum_sldr_title = jQuery('#sg_galleryalbum_sldr_title').val();
var sg_galleryalbum_sldr_description = jQuery('#sg_galleryalbum_sldr_description').val();
var sg_galleryalbum_sldr_full_content = jQuery('#sg_galleryalbum_sldr_full_content').val();
 var sg_galleryalbum_sldr_wordslimit = jQuery('#sg_galleryalbum_sldr_wordslimit').val();
var sg_galleryalbum_sldr_content_tail = jQuery('#sg_galleryalbum_sldr_content_tail').val();
var sg_galleryalbum_sldr_popup = jQuery('#sg_galleryalbum_sldr_popup').val();
 var sg_galleryalbum_sldr_grid = jQuery('#sg_galleryalbum_sldr_grid').val();
 var sg_galleryalbum_sldr_gallery_height = jQuery('#sg_galleryalbum_sldr_gallery_height').val();
var sg_galleryalbum_sldr_gallery_title = jQuery('#sg_galleryalbum_sldr_gallery_title').val();
 var sg_galleryalbum_sldr_gallery_caption = jQuery('#sg_galleryalbum_sldr_gallery_caption').val();
 var sg_galleryalbum_sdr_gallery_link_beh = jQuery('#sg_galleryalbum_sdr_gallery_link_beh').val();
var sg_galleryalbum_sldr_gallery_description = jQuery('#sg_galleryalbum_sldr_gallery_description').val();
var sg_galleryalbum_img_size = jQuery('#sg_galleryalbum_img_size').val();


    var sg_galleryalbum_sldr_cols = jQuery('#sg_galleryalbum_sldr_cols').val();
    var sg_galleryalbum_sldr = jQuery('#sg_galleryalbum_sldr').val();
    var sg_galleryalbum_sldr_pagi_dots = jQuery('#sg_galleryalbum_sldr_pagi_dots').val();
    var sg_galleryalbum_sldr_arr = jQuery('#sg_galleryalbum_sldr_arr').val();
    var sg_galleryalbum_sldr_autoplay = jQuery('#sg_galleryalbum_sldr_autoplay').val();
    
    var sg_galleryalbum_sldr_auto_int = jQuery('#sg_galleryalbum_sldr_auto_int').val();
    var sg_galleryalbum_sldr_speed = jQuery('#sg_galleryalbum_sldr_speed').val();

if (sg_albums_sldr_category != 'All' && sg_albums_sldr_category != 'all') {sg_main = sg_main + ' category="' + sg_albums_sldr_category + '"';}
 if (sg_albums_sldr_specific_albums != '') { sg_main = sg_main + ' id="' + sg_albums_sldr_specific_albums + '"';} 
sg_main = sg_main + ' limit="' + sg_galleryalbumsldr_limit + '"';
sg_main = sg_main + ' album_link_target="' + galleryalbum_sldr_link_beh + '"';
 if (galleryalbum_sldr_height == '') {sg_main = sg_main + ' album_height="auto"';} 
 else { sg_main = sg_main + ' album_height="' + galleryalbum_sldr_height + '"';}
sg_main = sg_main + ' album_title="' + sg_galleryalbum_sldr_title + '"';
sg_main = sg_main + ' album_description="' + sg_galleryalbum_sldr_description + '"';
sg_main = sg_main + ' album_full_content="' + sg_galleryalbum_sldr_full_content + '"';
if(sg_galleryalbum_sldr_wordslimit !=""){sg_main = sg_main + ' words_limit="' + sg_galleryalbum_sldr_wordslimit + '"';}
 
if (sg_galleryalbum_sldr_content_tail != '') {sg_main = sg_main + ' content_tail="' + sg_galleryalbum_sldr_content_tail + '"';} 

sg_main = sg_main + ' popup="' + sg_galleryalbum_sldr_popup + '"';
sg_main = sg_main + ' grid="' + sg_galleryalbum_sldr_grid + '"';
if (sg_galleryalbum_sldr_gallery_height == '') {sg_main = sg_main + ' gallery_height="auto"';} 
else {sg_main = sg_main + ' gallery_height="' + sg_galleryalbum_sldr_gallery_height + '"';}
sg_main = sg_main + 'show_title="' + sg_galleryalbum_sldr_gallery_title + '"';
sg_main = sg_main + 'show_caption="' + sg_galleryalbum_sldr_gallery_caption + '"';
sg_main = sg_main + 'link_target="' + sg_galleryalbum_sdr_gallery_link_beh + '"';
sg_main = sg_main + 'show_description="' + sg_galleryalbum_sldr_gallery_description + '"';
 sg_main = sg_main + ' image_size="' + sg_galleryalbum_img_size + '"';


 sg_main = sg_main + ' slidestoshow="' + sg_galleryalbum_sldr_cols + '"';
    sg_main = sg_main + ' slidestoscroll="' + sg_galleryalbum_sldr + '"';
    sg_main = sg_main + ' dots="' + sg_galleryalbum_sldr_pagi_dots + '"';
    sg_main = sg_main + ' arrows="' + sg_galleryalbum_sldr_arr + '"';
    sg_main = sg_main + ' autoplay="' + sg_galleryalbum_sldr_autoplay + '"';
    sg_main = sg_main + ' autoplay_interval="' + sg_galleryalbum_sldr_auto_int + '"';
    sg_main = sg_main + ' speed="' + sg_galleryalbum_sldr_speed + '"';

sg_main = sg_main + ']';
   jQuery("#shortcode_galleryalbumsldr").text(sg_main);
    jQuery("#php_shortcode_galleryalbumsldr").text("'"+sg_main+"'");
}