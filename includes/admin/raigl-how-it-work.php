<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Action to add menu
add_action('admin_menu', 'raigl_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_register_design_page() {
	add_submenu_page('edit.php?post_type=' . RAIGL_POST_TYPE, __('How it works, our plugins and offers', 'album-and-image-gallery-lightbox'), __('How It Works', 'album-and-image-gallery-lightbox'), 'manage_options', 'raigl-designs', 'raigl_designs_page');
}

/**
 * Function to display plugin design HTML
 * 
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_designs_page() {

	$wpos_feed_tabs = raigl_help_tabs();
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
	?>

	<div class="wrap raigl-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name = $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link = add_query_arg(array('post_type' => RAIGL_POST_TYPE, 'page' => 'raigl-designs', 'tab' => $tab_key), admin_url('edit.php'));
				?>

				<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

				<?php } ?>
			</h2>

			<div class="raigl-tab-cnt-wrp">
				<?php
				if (isset($active_tab) && $active_tab == 'how-it-work') {
					raigl_howitwork_page();
				} else if (isset($active_tab) && $active_tab == 'shortcode-generator') {
					raigl_shortcode_generator();
				}
				?>
			</div><!-- end .raigl-tab-cnt-wrp -->

		</div><!-- end .raigl-wrap -->

		<?php
	}

/**
 * Function to get plugin feed tabs
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_help_tabs() {
	$wpos_feed_tabs = array(
		'how-it-work' => array(
			'name' => __('How It Works', 'album-and-image-gallery-lightbox'),
		),
		'shortcode-generator' => array(
			'name' => __('Shortcode Generator', 'album-and-image-gallery-lightbox'),
			'url' => '#',
			'transient_key' => 'wpos_plugins_feed',
			'transient_time' => 172800
		),
	);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */
function raigl_howitwork_page() {
	?>

	<style type="text/css">
	.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
	.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
	.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
	.raigl-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.raigl-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
</style>

<div class="post-box-container">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!--How it workd HTML -->
			<div id="post-body-content">
				<div class="metabox-holder">
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">

							<h3 class="hndle">
								<span><?php _e('How It Works', 'album-and-image-gallery-lightbox'); ?></span>
							</h3>

							<div class="inside">
								<table class="form-table">
									<tbody>
										<tr>
											<th>
												<label><?php _e('Geeting Started with Album Gallery', 'album-and-image-gallery-lightbox'); ?>:</label>
											</th>
											<td>
												<ul>
													<li><?php _e('Step-1. Go to "Album Gallery --> Add Album Gallery tab".', 'album-and-image-gallery-lightbox'); ?></li>
													<li><?php _e('Step-2. Add Album title, description and images under Responsive Album and Image Gallery Lightbox - Settings.', 'album-and-image-gallery-lightbox'); ?></li>
													<li><?php _e('Step-3. Under "Choose Gallery Images" click on "Gallery Images" button and select multiple images from WordPress media and click on "Add to Gallery" button.', 'album-and-image-gallery-lightbox'); ?></li>
													<li><?php _e('Step-4. You can find out shortcode for album under "Album Gallery" list view.', 'album-and-image-gallery-lightbox'); ?></li>
												</ul>
											</td>
										</tr>

										<tr>
											<th>
												<label><?php _e('How Shortcode Works', 'album-and-image-gallery-lightbox'); ?>:</label>
											</th>
											<td>
												<ul>
													<li><?php _e('Step-1. Create a page like Album OR My Album.', 'album-and-image-gallery-lightbox'); ?></li>
													<li><?php _e('Step-2. Put below shortcode as per your need.', 'album-and-image-gallery-lightbox'); ?></li>
												</ul>
											</td>
										</tr>

										<tr>
											<th>
												<label><?php _e('All Shortcodes', 'album-and-image-gallery-lightbox'); ?>:</label>
											</th>
											<td>
												<span class="raigl-shortcode-preview">[raigl-gallery]</span> – <?php _e('Gallery Grid Shortcode', 'album-and-image-gallery-lightbox'); ?> <br />
												<span class="raigl-shortcode-preview">[raigl-gallery-slider]</span> – <?php _e('Gallery Slider Shortcode', 'album-and-image-gallery-lightbox'); ?> <br />
												<span class="raigl-shortcode-preview">[raigl-gallery-album]</span> – <?php _e('Image Album Grid Shortcode', 'album-and-image-gallery-lightbox'); ?> <br />
												<span class="raigl-shortcode-preview">[raigl-gallery-album-slider]</span> – <?php _e('Image Album Slider Shortcode', 'album-and-image-gallery-lightbox'); ?>
											</td>
										</tr>						

										
									</tbody>
								</table>
							</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables ui-sortable -->
				</div><!-- .metabox-holder -->
			</div><!-- #post-body-content -->

			<!--Upgrad to Pro HTML -->
			

		</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- #post-box-container -->
<?php
}

/**
 * Function to get 'Shortcode Generator' HTML
 *
 * @package Responsive Album and Image Gallery Lightbox
 * @since 1.0.0
 */


function raigl_shortcode_generator() {
	?>

	<!--Gallery Shortcode Shortcode Generator HTML -->

	<div id="post-body-content">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<h3 style="font-size: 18px;">
						<?php _e('Create Gallery Shortcode :-', 'album-and-image-gallery-lightbox') ?>
					</h3>

					<div class="inside">
						<table cellpadding="10" cellspacing="10">
							<tbody><tr><td valign="top">
								<div class="postbox" style="width:300px;">
									<form id="shortcode_generator" style="padding:20px;">
										<p>
											<label for="gal_albums">
												<?php _e(' Select Gallery:', 'album-and-image-gallery-lightbox') ?></label>
												<?php
												$gallery_albums = new WP_Query(array(
													'post_type' => RAIGL_POST_TYPE,
													'post_status' => 'publish',
													'orderby' => 'ID',
													'order' => 'DESC'
												));
												?>
												<select id="gal_albums" name="gal_albums" onchange="shortcodegenerategallery()">
													<?php
													while ($gallery_albums->have_posts()):
														$gallery_albums->the_post();
														?>
														<option value="<?php _e(get_the_ID(), 'album-and-image-gallery-lightbox') ?>">
															<?php _e(get_the_title(), 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endwhile; ?>
												</select>
											</p>

											<p>
												<label for="sg_grid"><?php _e(' Grid:', 'album-and-image-gallery-lightbox') ?></label>
												<?php $sg_grid = raigl_gallery_shortcode_grid() ?>
												<select id="sg_grid" name="sg_grid" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_grid as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_link_beh"><?php _e(' Link Behaviour:', 'album-and-image-gallery-lightbox') ?></label>
												<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
												<select id="sg_link_beh" name="sg_link_beh" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_link_beh as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_gallery_height"><?php _e('Gallery Height:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_gallery_height" name="sg_gallery_height" type="text" value="" onchange="shortcodegenerategallery()"><span class="howto"> <?php _e('(Leave blank for auto height)', 'album-and-image-gallery-lightbox'); ?></span></p>

											<p>
												<label for="sg_disp_title"><?php _e('Display Title:', 'album-and-image-gallery-lightbox'); ?> 
												</label>
												<?php $sg_disp_title = raigl_gallery_shortcode_disp_title() ?>
												<select id="sg_disp_title" name="sg_disp_title" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_disp_title as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_img_size"><?php _e('Image Size:', 'album-and-image-gallery-lightbox'); ?> </label>
												<?php $sg_img_size = raigl_gallery_shortcode_img_size() ?>
												<select id="sg_img_size" name="sg_img_size" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_img_size as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_disp_desc"><?php _e('Display Description:', 'album-and-image-gallery-lightbox'); ?></label>
												<?php $sg_disp_desc = raigl_gallery_shortcode_disp_caption() ?>
												<select id="sg_disp_desc" name="sg_disp_desc" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_disp_desc as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_disp_cap"><?php _e('Display Caption:', 'album-and-image-gallery-lightbox'); ?></label>
												<?php $sg_disp_cap = raigl_gallery_shortcode_disp_caption() ?>
												<select id="sg_disp_cap" name="sg_disp_cap" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_disp_cap as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

											<p><label for="sg_popup"><?php _e('Popup:', 'album-and-image-gallery-lightbox'); ?></label>
												<?php $sg_popup = raigl_gallery_shortcode_popup() ?>
												<select id="sg_popup" name="sg_popup" onchange="shortcodegenerategallery()">
													<?php foreach ($sg_popup as $k => $v): ?>
														<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
															<?php _e($v, 'album-and-image-gallery-lightbox') ?>
														</option>
													<?php endforeach; ?>
												</select>
											</p>

										</form>
									</div>
								</td>
								<td valign="top"><h3><?php _e('Shortcode:', 'album-and-image-gallery-lightbox'); ?></h3> 
									<p style="font-size: 16px;"><?php _e('Use this shortcode to display the list of Gallery in your posts or pages! Just copy this piece of text and place it where you want it to display.', 'album-and-image-gallery-lightbox'); ?> </p>

									<div id="shortcode" style="margin:20px 0; padding: 10px;
									background: #d7d7d7;font-size: 16px;border-left: 4px solid green;" >
								</div>
								<div style="margin:20px 0; padding: 10px;
								background: #d7d7d7;font-size: 16px;border-left: 4px solid green;" >
								&lt;?php do_shortcode(<span id="gallery_shortcode_php"></span>); ?&gt;
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div><!-- .inside -->
		<hr>
		<!-- Gallery Slider -->

		<h3 style="font-size: 18px;"><?php _e('Create Gallery Slider Shortcode :-', 'album-and-image-gallery-lightbox') ?>
		</h3>


		<div class="inside">
			<table cellpadding="10" cellspacing="10">
				<tbody><tr><td valign="top">
					<div class="postbox" style="width:300px;">
						<form id="shortcode_generator" style="padding:20px;">
							<label for="sldr_gal_albums"><?php _e('Select Gallery:', 'album-and-image-gallery-lightbox'); ?></label>
							<select id="sldr_gal_albums" name="sldr_gal_albums" onchange="shortcodegenerategallerysldr()">
								<?php
								while ($gallery_albums->have_posts()):
									$gallery_albums->the_post();
									?>
									<option value="<?php _e(get_the_ID(), 'album-and-image-gallery-lightbox') ?>">
										<?php _e(get_the_title(), 'album-and-image-gallery-lightbox') ?>
									</option>
								<?php endwhile; ?>
							</select>
							<p><label for="sg_sldr_link_beh"><?php _e('Link Behaviour:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
								<select id="sg_sldr_link_beh" name="sg_sldr_link_beh" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_link_beh as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_gallery_height"><?php _e('Gallery Height:', 'album-and-image-gallery-lightbox'); ?></label><input id="sg_sldr_gallery_height" name="sg_sldr_gallery_height" type="text" value="" onchange="shortcodegenerategallerysldr()"><span class="howto"> <?php _e('(Leave blank for auto height)', 'album-and-image-gallery-lightbox'); ?></span></p>

							<p>
								<label for="sg_sldr_disp_title"><?php _e('Display Title:', 'album-and-image-gallery-lightbox'); ?>
								</label>
								<?php $sg_disp_title = raigl_gallery_shortcode_disp_title() ?>
								<select id="sg_sldr_disp_title" name="sg_sldr_disp_title" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_disp_title as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_img_size"><?php _e('Image Size:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_img_size = raigl_gallery_shortcode_img_size() ?>
								<select id="sg_sldr_img_size" name="sg_sldr_img_size" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_img_size as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_disp_desc"><?php _e('Display Description:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_disp_desc = raigl_gallery_shortcode_disp_caption() ?>
								<select id="sg_sldr_disp_desc" name="sg_sldr_disp_desc" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_disp_desc as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_disp_cap"><?php _e('Display Caption:', 'album-and-image-gallery-lightbox'); ?> </label>
								<?php $sg_disp_cap = raigl_gallery_shortcode_disp_caption() ?>
								<select id="sg_sldr_disp_cap" name="sg_sldr_disp_cap" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_disp_cap as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_popup"><?php _e('Popup:', 'album-and-image-gallery-lightbox'); ?> </label>
								<?php $sg_popup = raigl_gallery_shortcode_popup() ?>
								<select id="sg_sldr_popup" name="sg_sldr_popup" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_popup as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_cols"><?php _e('Slider Columns:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_sldr_cols" name="sg_sldr_cols" value="1" type="text" value="" onchange="shortcodegenerategallerysldr()"><span class="howto"> <?php _e('(Display number of images at a time in slider e.g 1 or 2)', 'album-and-image-gallery-lightbox'); ?>  
							</span></p>
							<p><label for="sg_sldr_scr"><?php _e('Slides to Scroll:', 'album-and-image-gallery-lightbox'); ?></label><input id="sg_sldr_scr" name="sg_sldr_scr" value="1" type="text" value="" onchange="shortcodegenerategallerysldr()"><span class="howto"> <?php _e('(Scroll number of images at a time e.g 1 or 2):', 'album-and-image-gallery-lightbox'); ?></span></p>

							<p><label for="sg_pagi_dots"><?php _e('Slider Pagination Dots:', 'album-and-image-gallery-lightbox'); ?> </label>
								<?php $sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
								<select id="sg_pagi_dots" name="sg_pagi_dots" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_pagi_arr as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_arr"><?php _e('Slider Arrows:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
								<select id="sg_pagi_arr" name="sg_pagi_arr" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_pagi_arr as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_sldr_autoplay"><?php _e('Autoplay:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_sldr_autoplay = raigl_gallery_shortcode_sldr_autoplay() ?>
								<select id="sg_sldr_autoplay" name="sg_sldr_autoplay" onchange="shortcodegenerategallerysldr()">
									<?php foreach ($sg_sldr_autoplay as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>
							<p><label for="sg_sldr_auto_int"><?php _e('Autoplay Interval:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_sldr_auto_int" name="sg_sldr_auto_int" type="text" value="2000" onchange="shortcodegenerategallerysldr()"><span class="howto"><?php _e(' (Delay between two slides e.g. 3000)', 'album-and-image-gallery-lightbox'); ?> </span></p>
							<p><label for="sg_sldr_speed">Slider Speed:</label><input id="sg_sldr_speed" name="sg_sldr_speed" type="text" value="2000" onchange="shortcodegenerategallerysldr()"><span class="howto">
								<?php _e('  (Control speed of slider e.g. 3000)', 'album-and-image-gallery-lightbox'); ?></span></p>
							</form>
						</div>
					</td>
					<td valign="top"><h3><?php _e('Shortcode', 'album-and-image-gallery-lightbox'); ?></h3> 
						<p><?php _e('Use this shortcode to display the list of Gallery Slider in your posts or pages! Just copy this piece of text and place it where you want it to display.','album-and-image-gallery-lightbox');?></p>

						<div id="shortcode_sldr" style="padding:10px; padding: 10px;
						background: #d7d7d7;font-size: 16px;border-left: 4px solid green;
						margin: 20px 0;" >

					</div>
					<div style="margin:20px 0; padding: 10px;
					background: #d7d7d7;font-size: 16px;border-left: 4px solid green;" >
					&lt;?php do_shortcode(<span id="gallery_slider_shortcode_php"></span>); ?&gt;
				</div>



			</td>
		</tr>
	</tbody>
</table>
</div><!-- .inside -->
<hr>


<!-- Gallery Album -->
<h3 style="font-size: 18px;"><?php _e('Create Gallery Album Shortcode :-', 'album-and-image-gallery-lightbox') ?>
</h3>

<div class="inside">
	<table cellpadding="10" cellspacing="10">
		<tbody><tr><td valign="top">
			<div class="postbox" style="width:300px;">
				<form id="shortcode_generator" style="padding:20px;">
					<p>
						<label for="sg_specific_albums"><?php _e('Display Specific Album',
						'album-and-image-gallery-lightbox');?>:</label>

						<input id="sg_specific_albums" name="sg_specific_albums" type="text" value="" onchange="shortcodegenerategalleryalbum()"><span class="howto"> <?php _e( '(Leave blank for All, Enter specific Album id see in All Album gallery. like: 1,5,7)', 'album-and-image-gallery-lightbox') ?></span>
					</p>

					<p>
						<label for="sg_albums_category"><?php _e('Display By Category:', 'album-and-image-gallery-lightbox'); ?> </label>

						<?php $terms = get_terms(RAIGL_CAT); ?>

						<select id="sg_albums_category" 
						name="sg_galleryalbum_fullcontent" onchange="shortcodegenerategalleryalbum()">
						<option value="<?php _e( 'All', 'album-and-image-gallery-lightbox') ?>"> <?php _e( 'All', 'album-and-image-gallery-lightbox') ?></option>         
						<?php         
						foreach($terms as $taxonomy) {
							; ?>
							<option value="<?php echo $term_slug = $taxonomy->term_id; ?>">
								<?php _e( $term_slug = $taxonomy->name, 'album-and-image-gallery-lightbox') ?>
							</option>
							<?php }  ?> 
						</select>
					</p>    

					<p><label for="sg_galleryalbum_limit"><?php _e('Limit:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbum_limit" name="sg_galleryalbum_limit" type="text" value="-1" onchange="shortcodegenerategalleryalbum()"><span class="howto">
						<?php _e(' (How many Album display defoult value is -1(All) e.g. 1,2 etc.)', 'album-and-image-gallery-lightbox'); ?></span>
					</p>   
					<p>
						<label for="sg_galleryalbum_album_grid"><?php _e('Album Grid:', 'album-and-image-gallery-lightbox'); ?></label>
						<?php $sg_grid = raigl_gallery_shortcode_grid(); ?>
						<select id="sg_galleryalbum_album_grid" name="sg_galleryalbum_album_grid" onchange="shortcodegenerategalleryalbum()">
							<?php foreach ($sg_grid as $k => $v): ?>
								<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
									<?php _e($v, 'album-and-image-gallery-lightbox') ?>
								</option>
							<?php endforeach; ?>
						</select>
					</p>
					<p><label for="sg_galleryalbum_album_link_beh"><?php _e('Album Link Behaviour:', 'album-and-image-gallery-lightbox'); ?> </label>
						<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
						<select id="sg_galleryalbum_album_link_beh" name="sg_galleryalbum_album_link_beh" onchange="shortcodegenerategalleryalbum()">
							<?php foreach ($sg_link_beh as $k => $v): ?>
								<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
									<?php _e($v, 'album-and-image-gallery-lightbox') ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span class="howto"><?php _e('(open in a new tab or not.):', 'album-and-image-gallery-lightbox'); ?> </span>
					</p>
					<p>
						<label for="sg_galleryalbum_album_height"> <?php _e('Album Height:', 'album-and-image-gallery-lightbox'); ?></label>
						<input id="sg_galleryalbum_album_height" name="sg_galleryalbum_album_height" type="text" value="" onchange="shortcodegenerategalleryalbum()"><span class="howto"> <?php _e('(Control height in of the album.)', 'album-and-image-gallery-lightbox'); ?></span>
					</p>
					<p><label for="sg_galleryalbum_title"><?php _e('Album Title:', 'album-and-image-gallery-lightbox'); ?> </label>:
						<?php
						$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
						<select id="sg_galleryalbum_title" 
						name="sg_galleryalbum_title" onchange="shortcodegenerategalleryalbum()">
						<?php foreach ($sg_pagi_arr as $k => $v): ?>
							<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
								<?php _e($v, 'album-and-image-gallery-lightbox') ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>


				<p><label for="sg_galleryalbum_description"><?php _e('Album Description:', 'album-and-image-gallery-lightbox'); ?> </label>:
					<?php
					$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
					<select id="sg_galleryalbum_description" 
					name="sg_galleryalbum_description" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_pagi_arr as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="sg_galleryalbum_fullcontent"><?php _e('Album Full Content:', 'album-and-image-gallery-lightbox'); ?> </label>:
				<?php
				$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
				<select id="sg_galleryalbum_fullcontent" 
				name="sg_galleryalbum_fullcontent" onchange="shortcodegenerategalleryalbum()">
				<?php foreach ($sg_pagi_arr as $k => $v): ?>
					<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
						<?php _e($v, 'album-and-image-gallery-lightbox') ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="sg_galleryalbum_wordslimit"><?php _e('Words Limit:', 'album-and-image-gallery-lightbox'); ?> </label>
			<input id="sg_galleryalbum_wordslimit" name="sg_galleryalbum_wordslimit" type="text" value="" onchange="shortcodegenerategalleryalbum()"><span class="howto"> 
				<?php _e('(like: 10,15 20, etc.)', 'album-and-image-gallery-lightbox'); ?> </span>
			</p>

			<p><label for="sg_galleryalbum_popup"><?php _e('Popup:', 'album-and-image-gallery-lightbox'); ?></label>
				<?php $sg_galleryalbum_popup = raigl_gallery_shortcode_popup() ?>
				<select id="sg_galleryalbum_popup" name="sg_galleryalbum_popup" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_galleryalbum_popup as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="sg_galleryalbum_gallery_grid"><?php _e('Gallery Grid:', 'album-and-image-gallery-lightbox'); ?></label>
				<?php $sg_grid = raigl_gallery_shortcode_grid(); ?>
				<select id="sg_galleryalbum_gallery_grid" name="sg_galleryalbum_gallery_grid" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_grid as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="sg_galleryalbum_height"><?php _e('Gallery Height:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbum_height" name="sg_galleryalbum_height" type="text" value="" onchange="shortcodegenerategalleryalbum()"><span class="howto"> <?php _e('(Leave blank for auto height)', 'album-and-image-gallery-lightbox'); ?></span></p>

			<p>
				<label for="sg_galleryalbum_gallery_title"><?php _e('Display gallery Title:', 'album-and-image-gallery-lightbox'); ?>
				</label>
				<?php $sg_disp_title = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_gallery_title" name="sg_galleryalbum_gallery_title" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_disp_title as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="sg_galleryalbum_gallery_caption"><?php _e('Display gallery Caption:', 'album-and-image-gallery-lightbox'); ?>
				</label>
				<?php $sg_disp_caption = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_gallery_caption" name="sg_galleryalbum_gallery_caption" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_disp_caption as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="sg_galleryalbum_gallery_link_beh"><?php _e('Gallery Link Behaviour:', 'album-and-image-gallery-lightbox'); ?> </label>
				<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
				<select id="sg_galleryalbum_gallery_link_beh" name="sg_galleryalbum_gallery_link_beh" onchange="shortcodegenerategalleryalbum()">
					<?php foreach ($sg_link_beh as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
				<span class="howto"><?php _e('(open in a new tab or not.):', 'album-and-image-gallery-lightbox'); ?> </span>
			</p>

			<p><label for="sg_galleryalbum_gallery_description"><?php _e('Display gallery Description:', 'album-and-image-gallery-lightbox'); ?> </label>
				<?php $sg_link_beh = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_gallery_description" 
				name="sg_galleryalbum_gallery_description" onchange="shortcodegenerategalleryalbum()">
				<?php foreach ($sg_link_beh as $k => $v): ?>
					<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
						<?php _e($v, 'album-and-image-gallery-lightbox') ?>
					</option>
				<?php endforeach; ?>
			</select>

		</p>
		<p>
			<label for="sg_galleryalbum_img_size"><?php _e('Image Size:', 'album-and-image-gallery-lightbox'); ?>
			</label>
			<?php $sg_galleryalbum_img_size = raigl_gallery_shortcode_img_size() ?>
			<select id="sg_galleryalbum_img_size" name="sg_galleryalbum_img_size" onchange="shortcodegenerategalleryalbum()">
				<?php foreach ($sg_galleryalbum_img_size as $k => $v): ?>
					<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
						<?php _e($v, 'album-and-image-gallery-lightbox') ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>


									



	</form>
</div>
</td>
<td valign="top"><h3><?php _e('Shortcode', 'album-and-image-gallery-lightbox'); ?></h3> 
	<p style="font-size: 16px;"><?php _e('Use this shortcode to display the list of Gallery Album in your posts or pages! Just copy this piece of text and place it where you want it to display.', 'album-and-image-gallery-lightbox'); ?> </p>

	<div id="shortcode_galleryalbum" style="padding:10px; padding: 10px;
	background: #d7d7d7;font-size: 16px;border-left: 4px solid green;
	margin: 20px 0;" >

</div>
<div style="margin:20px 0; padding: 10px;
background: #d7d7d7;font-size: 16px;border-left: 4px solid green;" >
&lt;?php do_shortcode(<span id="php_shortcode_galleryalbum"></span>); ?&gt;
</div>



</td></tr></tbody></table>
</div><!-- .inside -->


<hr>
<!-- Gallery Album Slider -->

<h3 style="font-size: 18px;"><?php _e('Create Gallery Album Slider Shortcode :-', 'album-and-image-gallery-lightbox') ?>
</h3>
<div class="inside">
	<table cellpadding="10" cellspacing="10">
		<tbody><tr><td valign="top">
			<div class="postbox" style="width:300px;">
				<form id="shortcode_generator" style="padding:20px;">


					<p>
						<label for="sg_albums_sldr_specific_albums"><?php _e('Display Specific Album',
						'album-and-image-gallery-lightbox');?>:</label>

						<input id="sg_albums_sldr_specific_albums" name="sg_albums_sldr_specific_albums" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto"> <?php _e( '(Leave blank for All, Enter specific Album id see in All Album gallery. like: 1,5,7)', 'album-and-image-gallery-lightbox') ?></span>
					</p>

					<p>
						<label for="sg_albums_sldr_category"><?php _e('Display By Category:', 'album-and-image-gallery-lightbox'); ?> </label>

						<?php $terms = get_terms(RAIGL_CAT); ?>

						<select id="sg_albums_sldr_category" 
						name="sg_albums_sldr_category" onchange="shortcodegenerategalleryalbumsldr()">
						<option value="<?php _e( 'All', 'album-and-image-gallery-lightbox') ?>"> <?php _e( 'All', 'album-and-image-gallery-lightbox') ?></option>         
						<?php         
						foreach($terms as $taxonomy) {
							; ?>
							<option value="<?php echo $term_slug = $taxonomy->term_id; ?>">
								<?php _e( $term_slug = $taxonomy->name, 'album-and-image-gallery-lightbox') ?>
							</option>
							<?php }  ?> 
						</select>
					</p>  

					<p><label for="sg_galleryalbumsldr_limit"><?php _e('Limit:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbumsldr_limit" name="sg_galleryalbumsldr_limit" type="text" value="-1" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto">
						<?php _e(' (How many Album display defoult value is -1 e.g. 1,2 etc.)', 'album-and-image-gallery-lightbox'); ?></span>
					</p>   	

             <p><label for="sg_galleryalbum_sldr_link_beh"><?php _e('Album Link Behaviour:', 'album-and-image-gallery-lightbox'); ?> </label>
						<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
						<select id="sg_galleryalbum_sldr_link_beh" name="sg_galleryalbum_sldr_link_beh" onchange="shortcodegenerategalleryalbumsldr()">
							<?php foreach ($sg_link_beh as $k => $v): ?>
								<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
									<?php _e($v, 'album-and-image-gallery-lightbox') ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span class="howto"><?php _e('(open in a new tab or not.):', 'album-and-image-gallery-lightbox'); ?> </span>
			</p>

			<p>
						<label for="sg_galleryalbum_sldr_height"> <?php _e('Album Height:', 'album-and-image-gallery-lightbox'); ?></label>
						<input id="sg_galleryalbum_sldr_height" name="sg_galleryalbum_sldr_height" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()">
						<span class="howto">
					<?php _e('(Control height in of the album.)', 'album-and-image-gallery-lightbox'); ?>
						
					</span>
			</p>

			<p><label for="sg_galleryalbum_sldr_title"><?php _e('Album Title:', 'album-and-image-gallery-lightbox'); ?> </label>:
						<?php
						$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
						<select id="sg_galleryalbum_sldr_title" 
						name="sg_galleryalbum_sldr_title" onchange="shortcodegenerategalleryalbumsldr()">
						<?php foreach ($sg_pagi_arr as $k => $v): ?>
							<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
								<?php _e($v, 'album-and-image-gallery-lightbox') ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>
				<p><label for="sg_galleryalbum_sldr_description"><?php _e('Album Description:', 'album-and-image-gallery-lightbox'); ?> </label>:
						<?php
						$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
						<select id="sg_galleryalbum_sldr_description" 
						name="sg_galleryalbum_sldr_description" onchange="shortcodegenerategalleryalbumsldr()">
						<?php foreach ($sg_pagi_arr as $k => $v): ?>
							<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
								<?php _e($v, 'album-and-image-gallery-lightbox') ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>

				<p><label for="sg_galleryalbum_sldr_full_content"><?php _e('Album Full Content:', 'album-and-image-gallery-lightbox'); ?> </label>:
						<?php
						$sg_pagi_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
						<select id="sg_galleryalbum_sldr_full_content" 
						name="sg_galleryalbum_sldr_full_content" onchange="shortcodegenerategalleryalbumsldr()">
						<?php foreach ($sg_pagi_arr as $k => $v): ?>
							<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
								<?php _e($v, 'album-and-image-gallery-lightbox') ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>

				<p>
			<label for="sg_galleryalbum_sldr_wordslimit"><?php _e('Words Limit:', 'album-and-image-gallery-lightbox'); ?> </label>
			<input id="sg_galleryalbum_sldr_wordslimit" name="sg_galleryalbum_sldr_wordslimit" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto"> 
				<?php _e('(like: 10,15 20, etc.)', 'album-and-image-gallery-lightbox'); ?> </span>
			</p>

			<p>
						<label for="sg_galleryalbum_sldr_content_tail"> <?php _e('Content Tail:', 'album-and-image-gallery-lightbox'); ?></label>
						<input id="sg_galleryalbum_sldr_content_tail" name="sg_galleryalbum_sldr_content_tail" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()">
						<span class="howto">
					<?php _e('blank for default like: dots "..", Arrows ">>" etc.', 'album-and-image-gallery-lightbox'); ?>
						
					</span>
			</p>

			<p><label for="sg_galleryalbum_sldr_popup"><?php _e('Popup:', 'album-and-image-gallery-lightbox'); ?></label>
				<?php $sg_galleryalbum_sldr_popup = raigl_gallery_shortcode_popup() ?>
				<select id="sg_galleryalbum_sldr_popup" name="sg_galleryalbum_sldr_popup" onchange="shortcodegenerategalleryalbumsldr()">
					<?php foreach ($sg_galleryalbum_sldr_popup as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="sg_galleryalbum_sldr_grid"><?php _e('Gallery Grid:', 'album-and-image-gallery-lightbox'); ?></label>
				<?php $sg_grid = raigl_gallery_shortcode_grid(); ?>
				<select id="sg_galleryalbum_sldr_grid" name="sg_galleryalbum_sldr_grid" onchange="shortcodegenerategalleryalbumsldr()">
					<?php foreach ($sg_grid as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="sg_galleryalbum_sldr_gallery_height"><?php _e('Gallery Height:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbum_sldr_gallery_height" name="sg_galleryalbum_sldr_gallery_height" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto"> <?php _e('(Leave blank for auto height)', 'album-and-image-gallery-lightbox'); ?></span></p>

			<p>
				<label for="sg_galleryalbum_sldr_gallery_title"><?php _e('Display gallery Title:', 'album-and-image-gallery-lightbox'); ?>
				</label>
				<?php $sg_disp_title = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_sldr_gallery_title" name="sg_galleryalbum_sldr_gallery_title" onchange="shortcodegenerategalleryalbumsldr()">
					<?php foreach ($sg_disp_title as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="sg_galleryalbum_sldr_gallery_caption"><?php _e('Display gallery Caption:', 'album-and-image-gallery-lightbox'); ?>
				</label>
				<?php $sg_disp_caption = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_sldr_gallery_caption" 
				name="sg_galleryalbum_gallery_caption" onchange="shortcodegenerategalleryalbumsldr()">
					<?php foreach ($sg_disp_caption as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="sg_galleryalbum_sdr_gallery_link_beh"><?php _e('Gallery Link Behaviour:', 'album-and-image-gallery-lightbox'); ?> </label>:
				<?php $sg_link_beh = raigl_gallery_shortcode_link_target() ?>
				<select id="sg_galleryalbum_sdr_gallery_link_beh" name="sg_galleryalbum_sdr_gallery_link_beh" onchange="shortcodegenerategalleryalbumsldr()">
					<?php foreach ($sg_link_beh as $k => $v): ?>
						<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
							<?php _e($v, 'album-and-image-gallery-lightbox') ?>
						</option>
					<?php endforeach; ?>
				</select>
				<span class="howto"><?php _e('(open in a new tab or not.):', 'album-and-image-gallery-lightbox'); ?> </span>
			</p>

			<p><label for="sg_galleryalbum_sldr_gallery_description"><?php _e('Display gallery Description:', 'album-and-image-gallery-lightbox'); ?> </label>
				<?php $sg_link_beh = raigl_gallery_shortcode_disp_title() ?>
				<select id="sg_galleryalbum_sldr_gallery_description" 
				name="sg_galleryalbum_sldr_gallery_description" onchange="shortcodegenerategalleryalbumsldr()">
				<?php foreach ($sg_link_beh as $k => $v): ?>
					<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
						<?php _e($v, 'album-and-image-gallery-lightbox') ?>
					</option>
				<?php endforeach; ?>
			</select>

		</p>
		<p>
			<label for="sg_galleryalbum_sldr_gallery_img_size"><?php _e('Image Size:', 'album-and-image-gallery-lightbox'); ?>
			</label>
			<?php $sg_galleryalbum_sldr_gallery_img_size = raigl_gallery_shortcode_img_size() ?>
			<select id="sg_galleryalbum_sldr_gallery_img_size" name="sg_galleryalbum_sldr_gallery_img_size" onchange="shortcodegenerategalleryalbumsldr()">
				<?php foreach ($sg_galleryalbum_sldr_gallery_img_size as $k => $v): ?>
					<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
						<?php _e($v, 'album-and-image-gallery-lightbox') ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>


		<p><label for="sg_galleryalbum_sldr_cols"><?php _e('Slider Columns:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbum_sldr_cols" name="sg_galleryalbum_sldr_cols" value="1" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto"> <?php _e('(Display number of images at a time in slider e.g 1 or 2)', 'album-and-image-gallery-lightbox'); ?>  
							</span></p>
							<p><label for="sg_galleryalbum_sldr_scr"><?php _e('Slides to Scroll:', 'album-and-image-gallery-lightbox'); ?></label><input id="sg_galleryalbum_sldr" name="sg_galleryalbum_sldr" value="1" type="text" value="" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto"> <?php _e('(Scroll number of images at a time e.g 1 or 2):', 'album-and-image-gallery-lightbox'); ?></span></p>

							<p><label for="sg_galleryalbum_sldr_pagi_dots"><?php _e('Slider Pagination Dots:', 'album-and-image-gallery-lightbox'); ?> </label>
								<?php $sg_galleryalbum_sldr_pagi_dots = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
								<select id="sg_galleryalbum_sldr_pagi_dots" name="sg_galleryalbum_sldr_pagi_dots" onchange="shortcodegenerategalleryalbumsldr()">
									<?php foreach ($sg_galleryalbum_sldr_pagi_dots as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

<p><label for="sg_galleryalbum_sldr_arr"><?php _e('Slider Arrows:', 'album-and-image-gallery-lightbox'); ?>
	
</label>
								<?php $sg_galleryalbum_sldr_arr = raigl_gallery_shortcode_sldr_pagi_arrows() ?>
								<select id="sg_galleryalbum_sldr_arr" name="sg_galleryalbum_sldr_arr" onchange="shortcodegenerategalleryalbumsldr()">
									<?php foreach ($sg_galleryalbum_sldr_arr as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>

							<p><label for="sg_galleryalbum_sldr_autoplay"><?php _e('Autoplay:', 'album-and-image-gallery-lightbox'); ?></label>
								<?php $sg_galleryalbum_sldr_autoplay = raigl_gallery_shortcode_sldr_autoplay() ?>
								<select id="sg_galleryalbum_sldr_autoplay" name="sg_galleryalbum_sldr_autoplay" onchange="shortcodegenerategalleryalbumsldr()">
									<?php foreach ($sg_galleryalbum_sldr_autoplay as $k => $v): ?>
										<option value="<?php _e($v, 'album-and-image-gallery-lightbox') ?>">
											<?php _e($v, 'album-and-image-gallery-lightbox') ?>
										</option>
									<?php endforeach; ?>
								</select>
							</p>
							<p><label for="sg_galleryalbum_sldr_auto_int"><?php _e('Autoplay Interval:', 'album-and-image-gallery-lightbox'); ?> </label><input id="sg_galleryalbum_sldr_auto_int" name="sg_galleryalbum_sldr_auto_int" type="text" value="2000" onchange="shortcodegenerategalleryalbumsldr()">
								<span class="howto"><?php _e(' (Delay between two slides e.g. 3000)', 'album-and-image-gallery-lightbox'); ?> </span></p>

							<p><label for="sg_galleryalbum_sldr_speed">Slider Speed:</label><input id="sg_galleryalbum_sldr_speed" name="sg_galleryalbum_sldr_speed" type="text" value="2000" onchange="shortcodegenerategalleryalbumsldr()"><span class="howto">
								<?php _e('  (Control speed of slider e.g. 3000)', 'album-and-image-gallery-lightbox'); ?></span></p>

	




				</form>
			</div>
		</td>
		<td valign="top"><h3><?php _e('Shortcode', 'album-and-image-gallery-lightbox'); ?></h3> 
			<p><?php _e('Use this shortcode to display the list of Gallery Album Slider in your posts or pages! Just copy this piece of text and place it where you want it to display.','album-and-image-gallery-lightbox');?></p>

			<div id="shortcode_galleryalbumsldr" style="padding:10px; padding: 10px;
			background: #d7d7d7;font-size: 16px;border-left: 4px solid green;
			margin: 20px 0;" >

		</div>
		<div style="margin:20px 0; padding: 10px;
		background: #d7d7d7;font-size: 16px;border-left: 4px solid green;" >
		&lt;?php do_shortcode(<span id="php_shortcode_galleryalbumsldr"></span>); ?&gt;
	</div>



</td>
</tr>
</tbody>
</table>
</div><!-- .inside -->
<hr>


</div><!-- #general -->
</div><!-- .meta-box-sortables ui-sortable -->
</div><!-- .metabox-holder -->
</div><!-- #post-body-content -->




<?php } ?>