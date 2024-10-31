<?php

/**
 * Plugin generic functions file
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_esc_attr($data) {
    return esc_attr(stripslashes($data));
}

/**
 * Strip Slashes From Array
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_slashes_deep($data = array(), $flag = false) {

    if ($flag != true) {
        $data = raigl_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_nohtml_kses($data = array()) {

    if (is_array($data)) {

        $data = array_map('raigl_nohtml_kses', $data);
    } elseif (is_string($data)) {
        $data = trim($data);
        $data = wp_filter_nohtml_kses($data);
    }

    return $data;
}

/**
 * Function to unique number value
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_add_array(&$array, $value, $index, $from_last = false) {

    if (is_array($array) && is_array($value)) {

        if ($from_last) {
            $total_count = count($array);
            $index = (!empty($total_count) && ($total_count > $index)) ? ($total_count - $index) : $index;
        }

        $split_arr = array_splice($array, max(0, $index));
        $array = array_merge($array, $value, $split_arr);
    }

    return $array;
}

/**
 * Function to get post featured image
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_get_image_src($post_id = '', $size = 'full') {
    $size = !empty($size) ? $size : 'full';
    $image = wp_get_attachment_image_src($post_id, $size);

    if (!empty($image)) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    return $image;
}

/**
 * Function to get post excerpt
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_get_post_excerpt($post_id = null, $content = '', $word_length = '55', $more = '...') {

    $has_excerpt = false;
    $word_length = !empty($word_length) ? $word_length : '55';

    // If post id is passed
    if (!empty($post_id)) {
        if (has_excerpt($post_id)) {

            $has_excerpt = true;
            $content = get_the_excerpt();
        } else {
            $content = !empty($content) ? $content : get_the_content();
        }
    }

    if (!empty($content) && (!$has_excerpt)) {
        $content = strip_shortcodes($content); // Strip shortcodes
        $content = wp_trim_words($content, $word_length, $more);
    }

    return $content;
}

/**
 * Function to get `igsp-gallery` shortcode designs
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_designs() {
    $design_arr = array(
        'design-1' => __('Design 1', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_designs', $design_arr);
}

/**
 * Function to get `igsp-gallery` shortcode designs
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_album_designs() {
    $design_arr = array(
        'design-1' => __('Design 1', 'album-and-image-gallery-lightbox'),
    );
    return apply_filters('raigl_album_designs', $design_arr);
}

/**
 * Function to get `Grid columns values` shortcode generator
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_gallery_shortcode_grid() {


    $design_arr[0] = __(1, 'album-and-image-gallery-lightbox');
    $design_arr[1] = __(2, 'album-and-image-gallery-lightbox');
    $design_arr[2] = __(3, 'album-and-image-gallery-lightbox');
    $design_arr[3] = __(4, 'album-and-image-gallery-lightbox');
    $design_arr[4] = __(5, 'album-and-image-gallery-lightbox');
    $design_arr[5] = __(6, 'album-and-image-gallery-lightbox');
    $design_arr[6] = __(7, 'album-and-image-gallery-lightbox');
    $design_arr[7] = __(8, 'album-and-image-gallery-lightbox');
    $design_arr[8] = __(9, 'album-and-image-gallery-lightbox');
    $design_arr[9] = __(10, 'album-and-image-gallery-lightbox');
    $design_arr[10] = __(11, 'album-and-image-gallery-lightbox');
    $design_arr[11] = __(12, 'album-and-image-gallery-lightbox');

    return apply_filters('raigl_album_designs', $design_arr);
}

function raigl_gallery_shortcode_link_target() {
    $target_arr = array(
        __('self', 'album-and-image-gallery-lightbox'),
        __('blank', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $target_arr);
}

function raigl_gallery_shortcode_disp_title() {
    $disp_title_arr = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $disp_title_arr);
}

function raigl_gallery_shortcode_img_size() {
    $img_size_arr = array(
        __('full', 'album-and-image-gallery-lightbox'),
        __('medium', 'album-and-image-gallery-lightbox'),
        __('large', 'album-and-image-gallery-lightbox'),
        __('thumbnail', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $img_size_arr);
}

function raigl_gallery_shortcode_disp_desc() {
    $disp_desc = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $disp_desc);
}

function raigl_gallery_shortcode_disp_caption() {
    $disp_caption = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $disp_caption);
}

function raigl_gallery_shortcode_popup() {
    $disp_popup = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $disp_popup);
}

function raigl_gallery_shortcode_sldr_pagi_arrows() {
    $pagi_arrows = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $pagi_arrows);
}

function raigl_gallery_shortcode_sldr_autoplay() {
    $autoplay = array(
        __('true', 'album-and-image-gallery-lightbox'),
        __('false', 'album-and-image-gallery-lightbox')
    );
    return apply_filters('raigl_album_designs', $autoplay);
}