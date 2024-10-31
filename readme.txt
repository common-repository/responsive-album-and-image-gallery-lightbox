=== Responsive Album and Image Gallery Lightbox ===
Contributors: wponlinehelp, bhargavDholariya
Tags: bhargavDholariya, albums, image album, gallery, image gallery slider, gallery slider, album slider, lightbox, albums, best gallery plugin, image, image captions,  images, media, media gallery, magnific-popup, magnific image slider, image gallery, responsive image gallery, image slider,  photo, photo albums, photo gallery, photographer, fancybox, free photo gallery, galleries, gallery, photography, photos, picture, Picture Gallery, pictures, responsive, responsive galleries, responsive gallery, singlepic, slideshow, slideshow galleries, slideshow gallery, slideshows, thumbnail galleries, thumbnail gallery, thumbnails, watermarking, watermarks, wordpress gallery plugin, wordpress photo gallery plugin, wordpress responsive gallery, wp gallery, wp gallery plugins
Requires at least: 2.0
Tested up to: 4.9.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy way to add image and display album and image gallery lightbox in a grid or slider with lightbox.

== Description ==
A very simple plugin to add Responsive image gallery, Responsive image album in your post, page and custom post type section and display it on frontend of your website in a Grid, Slider or carousel view with the help of shorcode. The gallery field provides. 

Gallery Plugin enables you to create several media such as image gallery, photo albums, portfolio and also simple picture to an image slider or image lightbox and image carousel.

**This plugin contain four shortcode:-**

= Here is the shortcode example =

* Responsive Gallery Grid Shortcode: 
<code>[raigl-gallery]</code> 
 
* Responsive  Gallery Slider Shortcode: 
<code>[raigl-gallery-slider]</code> 

* Responsive Image Album Grid Shortcode: 
<code>[raigl-gallery-album]</code>  

* Responsive Image Album Slider Shortcode: 
<code>[raigl-gallery-album-slider]</code> 

Where you can display image gallery and image album with lightbox

= Use Following Responsive Gallery parameters with shortcode =
<code>[raigl-gallery]</code>

* **ID:** [raigl-gallery id="5"] (Gallery id for which you want to display images.)
* **Grid:** [raigl-gallery grid="1"] (Number of columns for image gallery. Values are 1 to 12)
* **Link Behaviour:** [raigl-gallery link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Gallery Height:** [raigl-gallery gallery_height="400"] (Control height of the image. You can enter any numeric number. You can set "auto" for auto height.)
* **Display Title:** [raigl-gallery show_title="true"] (Display image title or not. Values are "true" OR "false")
* **Image Size:** [raigl-gallery image_size="full"] (Choose appropriate image size from the WordPress. Values are "full", "medium", "large" OR "thumbnail".)
* **Display Description:** [raigl-gallery show_description="true"] (Display image description. Values are "true" OR "false")
* **Display Caption:** [raigl-gallery show_caption="true"] (Display image caption. Values are "true" OR "false")
* **Popup:** [raigl-gallery popup="true"] (Display gallery image in a popup. Values are "true" OR "false")


= Use Following Responsive Gallery Slider parameters with shortcode =
<code>[raigl-gallery-slider]</code>

* **ID:** [raigl-gallery-slider id="5"] (Gallery id for which you want to display images.)
* **Link Behaviour:** [raigl-gallery-slider link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Gallery Height:** [raigl-gallery-slider gallery_height="400"] (Control height of the image. You can enter any numeric number. You can set "auto" for auto height.)
* **Display Title:** [raigl-gallery-slider show_title="true"] (Display image title or not. Values are "true" OR "false")
* **Display Description:** [raigl-gallery-slider show_description="true"] (Display image description. Values are "true" OR "false")
* **Display Caption:** [raigl-gallery-slider show_caption="true"] (Display image caption. Values are "true" OR "false")
* **Image Size:** [raigl-gallery-slider image_size="full"] (Choose appropriate image size from the WordPress. Values are "full", "medium", "large" OR "thumbnail".)
* **Popup:** [raigl-gallery-slider popup="true"] (Display gallery image in a popup. Values are "true" OR "false")
* **Slider Columns:** [raigl-gallery-slider slidestoshow="2"] (Display number of images at a time in slider.)
* **Slides to Scroll:** [raigl-gallery-slider slidestoscroll="2"] (Scroll number of images at a time.)
* **Slider Pagination and Arrows:** [raigl-gallery-slider dots="false" arrows="false"]
* **Autoplay:** [raigl-gallery-slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval:** [raigl-gallery-slider autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed:** [raigl-gallery-slider speed="3000"] (Control speed of slider.)


= Use Following Responsive Gallery Album parameters with shortcode =
<code>[raigl-gallery-album]</code>

* **Limit:** [raigl-gallery-album limit="5"] (how many Album you want to display.)
* **Album Grid:** [raigl-gallery-album album_grid="3"] (Number of columns for image album. Values are 1 to 12.)
* **Link Behaviour:** [raigl-gallery-album album_link_target="self"] (Choose link behaviour whether to open in a new tab or not. Values are "self" OR "blank")
* **Album Height:** [raigl-gallery-album album_height="400"] (Control height of the album. You can enter any numeric number.)
* **Album Title:** [raigl-gallery-album album_title="true"] (Display album title. Values are "true" or "false".)
* **Album Description:** [raigl-gallery-album album_description="true"] (Display album description. Values are "true" or "false".)
* **Album Full Content:** [raigl-gallery-album album_full_content="true"] (Display album full description. Values are "true" or "false".)
* **Words Limit:** [raigl-gallery-album words_limit="40"] (Display number of words for album description.)
* **Content Tail (Continue Reading):** [raigl-gallery-album content_tail="..."] (Display three dots as a contineous reading.)
* **Display Specific Album:** [raigl-gallery-album id="5,10"] (Display specific album.)
* **Display By Category:** [raigl-gallery-album category="category_id"] (Display album by their category ID.)
* **Popup:** [raigl-gallery-album popup="true"] (Display gallery image in a popup. Values are "true" OR "false")
* **Grid:** [raigl-gallery-album grid="1"] (Number of columns for image gallery. Values are 1 to 12)
* **Gallery Height:** [raigl-gallery-album gallery_height="400"] (Control height of the image. You can enter any numeric number. You can set "auto" for auto height.)

* **Display Caption:** [raigl-gallery-album show_caption="true"] (Display image caption. Values are "true" OR "false")
* **Link Behaviour:** [raigl-gallery-album link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Display Title:** [raigl-gallery-album show_title="true"] (Display image title or not. Values are "true" OR "false")
* **Display Description:** [raigl-gallery-album show_description="true"] (Display image description. Values are "true" OR "false")

* **Image Size:** [raigl-gallery-album image_size="full"] (Choose appropriate image size from the WordPress. Values are "full", "medium", "large" OR "thumbnail".)


= Use Following Responsive Gallery Album Slider parameters with shortcode =
<code>[raigl-gallery-album-slider]</code>

* **Limit:** [raigl-gallery-album-slider limit="5"] (How many Album you want to display in slider.)
* **Link Behaviour:** [raigl-gallery-album-slider album_link_target="self"] (Choose link behaviour whether to open in a new tab or not. Values are "self" OR "blank")
* **Album Height:** [raigl-gallery-album-slider album_height="400"] (Control height of the album. You can enter any numeric number.)
* **Album Title:** [raigl-gallery-album-slider album_title="true"] (Display album title. Values are "true" or "false".)
* **Album Description:** [raigl-gallery-album-slider album_description="true"] (Display album description. Values are "true" or "false".)
* **Album Full Content:** [raigl-gallery-album-slider album_full_content="true"] (Display album full description. Values are "true" or "false".)

* **Words Limit:** [raigl-gallery-album-slider words_limit="40"] (Display number of words for album description.)
* **Content Tail (Continue Reading):** [raigl-gallery-album-slider content_tail="..."] (Display three dots as a contineous reading.)
* **Display Specific Album:** [raigl-gallery-album-slider id="5,10"] (Display specific album.)
* **Display By Category:** [raigl-gallery-album-slider category="category_id"] (Display album by their category ID.)
* **Popup:** [raigl-gallery-album-slider popup="true"] (Display gallery image in a popup. Values are "true" OR "false")
* **Grid:** [raigl-gallery-album-slider grid="1"] (Number of columns for image gallery. Values are 1 to 12)
* **Gallery Height:** [raigl-gallery-album-slider gallery_height="400"] (Control height of the image. You can enter any numeric number. You can set "auto" for auto height.)
* **Display Caption:** [raigl-gallery-album-slider show_caption="true"] (Display image caption. Values are "true" OR "false")
* **Link Behaviour:** [raigl-gallery-album-slider link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Display Title:** [raigl-gallery-album-slider show_title="true"] (Display image title or not. Values are "true" OR "false")

* **Display Description:** [raigl-gallery-album-slider show_description="true"] (Display image description. Values are "true" OR "false")

* **Image Size:** [raigl-gallery-album-slider image_size="full"] (Choose appropriate image size from the WordPress. Values are "full", "medium", "large" OR "thumbnail".)
* **Slider Columns:** [raigl-gallery-album-slider album_slidestoshow="2"] (Display number of images at a time in slider.)
* **Slides to Scroll:** [raigl-gallery-album-slider album_slidestoscroll="2"] (Scroll number of images at a time.)
* **Slider Pagination and Arrows:** [raigl-gallery-album-slider album_dots="false" album_arrows="false"]
* **Autoplay:** [raigl-gallery-album-slider album_autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval:** [raigl-gallery-album-slider album_autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed:** [raigl-gallery-album-slider album_speed="3000"] (Control speed of slider.)


= Template code is =
<code><?php echo do_shortcode('[raigl-gallery]'); ?></code>
<code><?php echo do_shortcode('[raigl-gallery-slider]'); ?></code>
<code><?php echo do_shortcode('[raigl-gallery-album]'); ?></code>
<code><?php echo do_shortcode('[raigl-gallery-album-slider]'); ?></code>


= Available Features : =
* Gallery Grid
* Gallery Slider
* Image Album Grid
* Image Album Slider
* Category wise album
* Easy Drag & Drop image feature
* Strong shortcode parameters
* Slider RTL support
* Fully responsive
* 100% Multilanguage

== Installation ==

1. Upload the 'Responsive Album and Image Gallery Lightbox' folder to the '/wp-content/plugins/' directory.
2. Activate the "Responsive Album and Image Gallery Lightbox" list plugin through the 'Plugins' menu in WordPress.
3. Add a new page and add desired short code in that.



== Screenshots ==
1. How to Create album Gallery
2. List of All Album
3. How to Add Shortcode in Page
4  View album in grid and slider 



== Changelog ==
= 2.0 =
* New css and js add

= 1.0 =
* Initial release.

== Upgrade Notice ==
= 2.0 =
added new css and js file

= 1.0 =
Initial release