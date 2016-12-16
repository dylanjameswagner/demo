<?php

	// -------------------------------------------------------------------- //
	// options.php

//	require (TEMPLATEPATH.'/includes/wordpress.php');

	$cms_options		= get_option('cms_options');

	$thm_title			= get_option('current_theme');
	$thm_slug			= strtolower($theme_name);
	$thm_url			= get_bloginfo('template_url');

	$pge_front			= get_option('show_on_front');

	$pge_front_title	= get_the_title(get_option('page_on_front'));
	$pge_front_slug		= get_post($pge_front_id)->post_name;

	$pge_posts_title	= get_the_title(get_option('page_for_posts'));
	$pge_posts_slug		= get_post($pge_posts_id)->post_name;

	if ($pge_front == 'posts'){
		$pge_posts_title	= 'Blog';
		$pge_posts_slug		= 'blog';
	}

/*	echo '['.$pge_front.']';
	if ($cms_options['nav_exclude_front']){ echo $chk; } if ($pge_front == 'posts'){ echo 'dis'; } ?><?php if ($pge_front == 'page' && $pge_front_title){ echo ' &ldquo;<em>'.$pge_front_title.'</em>&rdquo;'; } */

	class options {

		function options(){
			global $cms_options, $pge_posts_title, $pge_posts_slug;

			add_action('admin_head', array(&$this, 'admin_head'));
			add_action('admin_menu', array(&$this, 'admin_menu'));

			if (function_exists('register_sidebar')){

				$tab = str_repeat("\t", 4);
				
//				if (empty($cms_options['sidebars_dynamic'])){
					$sidebars_default = 'Blog, Pages';
//				}
				
				if ($cms_options['sidebars_dynamic']){
					// multi sidebars - options
					$sidebars = explode(', ', $cms_options['sidebars_dynamic']);
				} else {
															$sidebars = array();
					// multi sidebars
					if ($pge_posts_slug){					$sidebars[] = $pge_posts_slug;		
															$sidebars[] = 'pages';
						if (function_exists('shopp')){		$sidebars[] = 'shop'; }
					} else {								$sidebars[] = 'default'; } // single sidebar
				}

				$i = 0;
				
				while ($i < count($sidebars)){
					register_sidebar(array(
						'name'			=> $sidebars[$i],
						'before_widget'	=> $tab.'<li id="%1$s" class="widget %2$s">'.PHP_EOL,
						'after_widget'	=> $tab.'</li><!--%1$s-->'.PHP_EOL,
						'before_title'	=> $tab."\t".'<h3>',
						'after_title'	=> '</h3>'.PHP_EOL
					));

					$i++;
				}
			}
		}

		function admin_head(){
			global $cms_options, $thm_url;
			
			if ($cms_options['admin_favicon']){
				echo '<link rel="shortcut icon" type="image/x-icon" href="'.$thm_url.'/images/cms/favicon.ico"/>'.PHP_EOL;
			}
			echo '<link rel="stylesheet" type="text/css" href="'.$thm_url.'/styles/options.css" media="screen"/>'.PHP_EOL;
		}

		function admin_menu(){
			global $cms_options, $thm_title;

//			add_theme_page($thm_title.' Options', 'Theme Options', 'edit_themes', 'cms_options', array(&$this, 'admin_options'));
			add_theme_page('Theme Options', 'Theme Options', 'edit_themes', __FILE__, array(&$this, 'admin_options'));
		}

		function admin_options(){
			global $cms_options, $thm_title, $thm_slug, $pge_front_title, $pge_posts_title;

			$chk				= ' checked="checked"';
			$dis				= ' disabled="disabled"';
			$sel				= ' selected="selected"';

/*			// variables for the field and option names 
			$opt_name			= 'mt_favorite_food';
			$hidden_field_name	= 'mt_submit_hidden';
			$data_field_name	= 'mt_favorite_food';

			// Read in existing option value from database
			$opt_val			= get_option($opt_name); */

			// update options
			if (!empty($_POST['submit'])){
				$cms_options							= array();										// clear array

				$cms_options['admin_favicon']			= addslashes($_POST['cms_admin_favicon']);

				$cms_options['doctype']					= addslashes($_POST['cms_doctype']);
				$cms_options['doctype_include']			= addslashes(str_replace(' ', '', $_POST['cms_doctype_include']));

				$cms_options['meta']					= addslashes($_POST['cms_meta']);
				$cms_options['meta_description']		= $_POST['cms_meta_description'];
				$cms_options['meta_keywords']			= $_POST['cms_meta_keywords'];

				$cms_options['nav_depth']				= addslashes($_POST['cms_nav_depth']);
				$cms_options['nav_exclude']				= addslashes(str_replace(' ', '', $_POST['cms_nav_exclude']));
				$cms_options['nav_exclude_children']	= addslashes($_POST['cms_nav_exclude_children']);
				$cms_options['nav_exclude_front']		= addslashes($_POST['cms_nav_exclude_front']);
				$cms_options['nav_footer']				= addslashes($_POST['cms_nav_footer']);
				$cms_options['nav_categories']			= addslashes($_POST['cms_nav_categories']);
				$cms_options['nav_sibling']				= addslashes($_POST['cms_nav_sibling']);
				$cms_options['nav_sibling_include']		= addslashes(str_replace(' ', '', $_POST['cms_nav_sibling_include']));
				$cms_options['nav_child']				= addslashes($_POST['cms_nav_child']);
				$cms_options['nav_crumb']				= addslashes($_POST['cms_nav_crumb']);
				$cms_options['nav_crumb_archive']		= addslashes($_POST['cms_nav_crumb_archive']);
				$cms_options['nav_crumb_seperator']		= addslashes($_POST['cms_nav_crumb_seperator']);

				$cms_options['nav_anchor_icon']			= addslashes($_POST['cms_nav_anchor_icon']);

				$cms_options['nav_paged']				= addslashes($_POST['cms_nav_paged']);
				$cms_options['nav_paged_pages']			= addslashes($_POST['cms_nav_paged_pages']);
				$cms_options['nav_paged_page']			= addslashes($_POST['cms_nav_paged_page']);
				$cms_options['nav_paged_active']		= addslashes($_POST['cms_nav_paged_active']);
				$cms_options['nav_paged_previous']		= addslashes($_POST['cms_nav_paged_previous']);
				$cms_options['nav_paged_next']			= addslashes($_POST['cms_nav_paged_next']);
				$cms_options['nav_paged_first']			= addslashes($_POST['cms_nav_paged_first']);
				$cms_options['nav_paged_last']			= addslashes($_POST['cms_nav_paged_last']);
				$cms_options['nav_paged_sep_first']		= addslashes($_POST['cms_nav_paged_sep_first']);
				$cms_options['nav_paged_sep_last']		= addslashes($_POST['cms_nav_paged_sep_last']);
				$cms_options['nav_paged_num_pages']		= addslashes($_POST['cms_nav_paged_num_pages']);

				$cms_options['posts_date_images']		= addslashes($_POST['cms_posts_date_images']);
				$cms_options['posts_user_based']		= addslashes($_POST['cms_posts_user_based']);
				$cms_options['posts_excerpt']			= addslashes($_POST['cms_posts_excerpt']);
				$cms_options['posts_archive']			= addslashes($_POST['cms_posts_archive']);

				$cms_options['pages_img']				= addslashes(str_replace(' ', '', $_POST['cms_pages_img']));
				$cms_options['pages_links']				= addslashes($_POST['cms_pages_links']);
				$cms_options['pages_site-map']			= addslashes($_POST['cms_pages_site-map']);
				$cms_options['pages_contact_form']		= addslashes($_POST['cms_pages_contact_form']);
				$cms_options['pages_contact_map']		= addslashes($_POST['cms_pages_contact_map']);

				$cms_options['comments_posts']			= addslashes($_POST['cms_comments_posts']);
				$cms_options['comments_pages']			= addslashes($_POST['cms_comments_pages']);

				$cms_options['sidebars_dynamic']		= addslashes($_POST['cms_sidebars_dynamic']);
				$cms_options['sidebars_default']		= addslashes($_POST['cms_sidebars_default']);

				$cms_options['css_slideshow']			= addslashes($_POST['cms_css_slideshow']);
				$cms_options['css_iconize']				= addslashes($_POST['cms_css_iconize']);
				$cms_options['css_site-map']			= addslashes($_POST['cms_css_site-map']);

				$cms_options['js_tinybox']				= addslashes($_POST['cms_tinybox']);
				$cms_options['js_tinyaccordion']		= addslashes($_POST['cms_tinyaccordion']);

				$cms_options['jquery']					= addslashes($_POST['cms_jquery']);
				$cms_options['jquery_lightbox']			= addslashes($_POST['cms_jquery_lightbox']);
				$cms_options['jquery_thickbox']			= addslashes($_POST['cms_jquery_thickbox']);
				$cms_options['jquery_colorbox']			= addslashes($_POST['cms_jquery_colorbox']);
				$cms_options['jquery_innerfade']		= addslashes($_POST['cms_jquery_innerfade']);
				$cms_options['jquery_imageswitch']		= addslashes($_POST['cms_jquery_imageswitch']);
				$cms_options['jquery_tabswitch']		= addslashes($_POST['cms_jquery_tabswitch']);

				$cms_options['mootools']				= addslashes($_POST['cms_mootools']);
				$cms_options['mootools_imagemenu']		= addslashes($_POST['cms_mootools_imagemenu']);
				$cms_options['typeface']				= addslashes($_POST['cms_typeface']);
				$cms_options['typeface_faces']			= addslashes($_POST['cms_typeface_faces']);

				$cms_options['g_analytics_id']			= addslashes($_POST['cms_g_analytics_id']);
				$cms_options['g_adsense_id']			= addslashes($_POST['cms_g_adsense_id']);
				$cms_options['g_reader_id']				= addslashes($_POST['cms_g_reader_id']);
				$cms_options['g_maps_url']				= addslashes($_POST['cms_g_maps_url']);
				$cms_options['g_maps_code']				= addslashes($_POST['cms_g_maps_code']);

				$cms_options['olark']					= addslashes($_POST['cms_olark']);
				$cms_options['olark_id']				= addslashes($_POST['cms_olark_id']);
				$cms_options['addthis']					= addslashes($_POST['cms_addthis']);
				$cms_options['addthis_id']				= addslashes($_POST['cms_addthis_id']);
				$cms_options['addthis_services']		= addslashes($_POST['cms_addthis_services']);

				$cms_options['notice_ie6']				= addslashes($_POST['cms_notice_ie6']);
				$cms_options['notice_ie7']				= addslashes($_POST['cms_notice_ie7']);
				$cms_options['developer']				= addslashes($_POST['cms_developer']);
				$cms_options['validation']				= addslashes($_POST['cms_validation']);
				$cms_options['rss']						= addslashes($_POST['cms_rss']);
				$cms_options['dev_p2p']					= addslashes($_POST['cms_dev_p2p']);

				$update_cms_options_queries				= array();
				$update_cms_options_text				= array();
				$update_cms_options_queries[]			= update_option('cms_options', $cms_options);
				$update_cms_options_text				= 'CMS Options';

				foreach($update_cms_options_queries as $query){
					if($query){
						$text .= '<font color="green">'.$update_cms_options_text.' Updated</font><br/>';
					}
					$i++;
				}

				if(empty($text)){
					$text = '<font color="red">No '.$update_cms_options_text.' Updated</font><br/>';
				}
			}

			if (isset($_POST['info_update']) ){
				$new_options = $_POST['shrinkylink'];
				$bool_opts = array( 'comments', 'domain', 'elipse', 'posts', 'scheme', 'www' );
				foreach($bool_opts as $key){
					$new_options[$key] = $new_options[$key] ? 'yes' : 'no';
				}
				update_option( 'plugin_shrinkylink_settings', $new_options);
				echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
			}

			if(!empty($text)){
				echo '<!--last action--><div id="message" class="updated fade"><p>'.$text.'</p></div>';
			}
?>
<div id="<?php echo $thm_slug; ?>-theme_options" class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php echo $thm_title; ?> Theme Options</h2>
	<h3>This theme options page is still in development, some options maybe unavailable, disabled or currently unfinished.</h3>
	<p>Please do not make changes. These settings relate directly to the functionality &amp; presentation of the <?php echo $thm_title; ?> theme.<br/>
		For support please email developer(s) at <?php if ($cms_options['dev_p2p']){ ?><a href="mailto:dylan@point2pointcentral.com">dylan@point2pointcentral.com</a> or <a href="mailto:michael@point2pointcentral.com">michael@point2pointcentral.com</a><?php } else { ?><a href="mailto:hello@dylanjameswagner.com">hello@dylanjameswagner.com</a><?php } ?>.</p>
	<form name="cms_options" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<?php
	wp_nonce_field('update-options');
	/* <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y"> */
?>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable" style="position: relative;">
					<div id="notice-box" class="postbox">
						<div class="handlediv" title="Click to toggle">
							<br/>
						</div>
						<h3 class="hndle"><span>Notice</span></h3>
						<div class="inside" style="color: red;">
							<p>* Options marked with an asterisk may not be complete
								or implemented by default. Often activating or placing
								a function call is all that is needed to implement.</p>
							<p>Each option may list additional information.</p>
						</div>
					</div>
					<div id="save-box" class="postbox">
						<div class="handlediv" title="Click to toggle">
							<br/>
						</div>
						<h3 class="hndle"><span>Save</span></h3>
						<div class="inside" style="overflow: auto;">
<?php		
			function cms_options_classes($v, $i){
				if ($i & 1){		$cms_options_class[] = 'alt'; }
				if ($v == '-'){	$cms_options_class[] = 'null'; }

				if (!empty($cms_options_class)){
					foreach ($cms_options_class as $v){
						 echo ' '.$v;
					}
				}
			}

			function list_options(){
				global $cms_options, $ste_url;

				if (!empty($cms_options)){
					foreach ($cms_options as $k => $v){
						if ($v == NULL){
							$v = '-';
						}
						echo '<li class="';

						cms_options_classes($v, $i);

						echo '"><strong style="clear: both; float: left;">'.$k.'</strong> <span style="float: right;">'.$v.'</span></li>';

						$i++;
					}
				} else {
					echo '<li style="font-weight: bold; color: red;">There are no options being set.</li>';
				}
			}
//							<input type="hidden" name="action" value="update"/>
//							<input type="hidden" name="page_options" value="list_options()>"/>
?>
							<input type="submit" name="submit" class="button-primary" value="Update Options"/>
							<p><strong>List of options being set.</strong><br/>
								An option being set does not necessarily mean it has been implimented.</p>
							<ul>
<?php list_options(); ?>
							</ul>
							<p align="right"><a href="#wpwrap">Return to top</a></p>
						</div>
					</div>
				</div>
			</div><!--#side-info-column-->
			<div id="post-body" class="has-sidebar">
				<div id="post-body-content" class="has-sidebar-content">

					<table class="form-table">

					<tr valign="top"><th scope="row"><strong id="cms_admin">Admin</strong></th><td>
						<label><input type="checkbox"	name="cms_admin_favicon"		value="true"<?php if ($cms_options['admin_favicon']){ echo $chk; } ?>/> Display the <img src="<?php echo $thm_url; ?>/images/cms/favicon.ico" alt="" align="absmiddle"/> favicon in the admin panels</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_meta">Meta</strong><br/>
						Activate option and save to enable additional settings.</th><td>
						<label><select					name="cms_doctype"				class="large-text">
							<option value="strict"<?php if ($cms_options['doctype'] == 'strict'){ echo $sel; } ?>>Strict</option>
							<option value="transitional"<?php if ($cms_options['doctype'] == 'transitional'){ echo $sel; } ?>>Transitional</option>
						</select></label> Doctype for all pages<br/>
						<label><input type="text"		name="cms_doctype_include"		value="<?php echo str_replace(',', ', ', trim($cms_options['doctype_include'])); ?>" class="regular-text"<?php if ($cms_options['doctype'] == 'transitional'){ echo $dis; } ?>/><br/>
							Use the Transitional Doctype on these pages</label><br/>
						<label><input type="checkbox"	name="cms_meta"					value="true" <?php if ($cms_options['meta']){ echo $chk; } ?>/> Use the options below to define site-wide default meta tags Description &amp; Keywords</label><br/>
						<label><textarea 				name="cms_meta_description"		class="large-text" cols="50" rows="3" <?php if (!$cms_options['meta']){ echo ' '.rtrim($dis); } ?>><?php if (!empty($cms_options['meta_description'])){ echo stripslashes($cms_options['meta_description']); } else { meta_description(); } ?></textarea><br/>
							Meta Description</label><br/>
						<label><textarea 				name="cms_meta_keywords"		class="large-text" cols="50" rows="3" <?php if (!$cms_options['meta']){ echo ' '.rtrim($dis); } ?>><?php if (!empty($cms_options['meta_keywords'])){ echo stripslashes($cms_options['meta_keywords']); } else { meta_keywords(); } ?></textarea><br/>
							Meta Keywords - Comma Seprated list of keywords</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_navigation">Navigation</strong></th><td>
						<label><input type="text"		name="cms_nav_depth"			value="<?php if (!empty($cms_options['nav_depth'])){ echo $cms_options['nav_depth']; } else { echo 0; } ?>" class="small-text"/> Depth of the main navigation (0 = unlimited)</label><br/>
						<label><input type="text"		name="cms_nav_exclude"			value="<?php echo str_replace(',', ', ', $cms_options['nav_exclude']); ?>" class="regular-text"/><br/>
							Exclude page(s) from the main navigation(s) - Comma seperated list of ID(s)</label><br/>
						<label><input type="checkbox"	name="cms_nav_exclude_children"	value="true"<?php if ($cms_options['nav_exclude_children']){ echo $chk; } ?><?php if (!$cms_options['nav_exclude']){ echo $dis; } ?>/> Exclude automatically all children of the above listed pages</label><br/>
						<label><input type="checkbox"	name="cms_nav_exclude_front"	value="true"<?php if ($cms_options['nav_exclude_front']){ echo $chk; } if ($pge_front == 'posts'){ echo $dis; } ?>/> Exclude the front page<?php if ($pge_front == 'page' && $pge_front_title){ echo ' &ldquo;<em>'.$pge_front_title.'</em>&rdquo;'; } ?> from the main navigation(s)</label><br/>
						<label><input type="checkbox"	name="cms_nav_footer"			value="true"<?php if ($cms_options['nav_footer']){ echo $chk; } ?>/> Display footer navigation</label><br/>
						<label><input type="checkbox"	name="cms_nav_categories"		value="true"<?php if ($cms_options['nav_categories']){ echo $chk; } ?>/> Display categories navigation</label><br/>
						<label><input type="checkbox"	name="cms_nav_sibling"			value="true"<?php if ($cms_options['nav_sibling']){ echo $chk; } ?>/> Display sibling navigation</label><br/>
						<label><input type="text"		name="cms_nav_sibling_include"	value="<?php echo str_replace(',', ', ', trim($cms_options['nav_sibling_include'])); ?>" class="regular-text"<?php if (!$cms_options['nav_sibling']){ echo $dis; } ?>/><br/>
							Include silbling navigation on these page(s)</label><br/>
						<label><input type="checkbox"	name="cms_nav_child"			value="true"<?php if ($cms_options['nav_child']){ echo $chk; } ?>/> Supress child navigation</label><br/>
						<label><input type="checkbox"	name="cms_nav_crumb"			value="true"<?php if ($cms_options['nav_crumb']){ echo $chk; } ?>/> Supress breadcrumb navigation</label><br/>
						<label><input type="checkbox"	name="cms_nav_crumb_archive"	value="true"<?php if ($cms_options['nav_crumb_archive']){ echo $chk; } ?><?php if ($cms_options['nav_crumb']){ echo $dis; } ?>/> Display archive items in the breadcrumb navigation</label><br/>
						<label><input type="text"		name="cms_nav_crumb_seperator"	value="<?php if (!empty($cms_options['nav_crumb_seperator'])){	echo $cms_options['nav_crumb_seperator']; } else { echo '&raquo;'; } ?>" class="small-text"<?php if ($cms_options['nav_crumb']){ echo $dis; } ?>/> Seperator between breadcrumb navigation items</label><br/>
<!--					<label><input type="text"		name="cms_nav_anchor_icon"		value="<?php if (!empty($cms_options['nav_anchor_icon'])){	echo $cms_options['nav_anchor_icon']; } else { echo '&raquo;'; } ?>" class="small-text"/> Icon after significant anchors</label><br/> -->
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_pagination">Advanced Pagination</strong><br/>
						Available Variables:<br/>
						[T] - Total number pages<br/>
						[P] - Page number<br/>
						[A] - Active page number</th><td>
						<label><input type="checkbox"	name="cms_nav_paged"			value="true"<?php if ($cms_options['nav_paged']){ echo $chk; } ?>/> Use advanced pagination</label><br/>
						<label><input type="text"		name="cms_nav_paged_pages"		value="<?php if (!empty($cms_options['nav_paged_pages'])){		echo $cms_options['nav_paged_pages']; } else {		echo 'Page [A] of [T]'; } ?>"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text For Number of Pages</label><br/>
						<label><input type="text"		name="cms_nav_paged_page"		value="<?php if (!empty($cms_options['nav_paged_page'])){		echo $cms_options['nav_paged_page']; } else {		echo '[P]'; } ?>"		class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for page</label><br/>
						<label><input type="text"		name="cms_nav_paged_active"		value="<?php if (!empty($cms_options['nav_paged_active'])){	echo $cms_options['nav_paged_active']; } else {		echo '[A]'; } ?>"		class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for active page</label><br/>
						<label><input type="text"		name="cms_nav_paged_previous"	value="<?php if (!empty($cms_options['nav_paged_previous'])){	echo $cms_options['nav_paged_previous']; } else {	echo 'Previous'; } ?>"	class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for previous page/group link</label><br/>
						<label><input type="text" 		name="cms_nav_paged_next"		value="<?php if (!empty($cms_options['nav_paged_next'])){		echo $cms_options['nav_paged_next']; } else {		echo 'Next'; } ?>"		class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for next page/group link</label><br/>
						<label><input type="text"		name="cms_nav_paged_first"		value="<?php if (!empty($cms_options['nav_paged_first'])){		echo $cms_options['nav_paged_first']; } else {		echo 'First'; } ?>"		class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for first page link</label><br/>
						<label><input type="text"		name="cms_nav_paged_last"		value="<?php if (!empty($cms_options['nav_paged_last'])){		echo $cms_options['nav_paged_last']; } else {		echo 'Last'; } ?>"		class="medium-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Text for last page link</label><br/>
						<label><input type="text"		name="cms_nav_paged_sep_first"	value="<?php if (!empty($cms_options['nav_paged_sep_first'])){	echo $cms_options['nav_paged_sep_first']; } else {	echo '|'; } ?>"			class="small-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Seperator between first and previous</label><br/>
						<label><input type="text"		name="cms_nav_paged_sep_last"	value="<?php if (!empty($cms_options['nav_paged_sep_last'])){	echo $cms_options['nav_paged_sep_last']; } else {	echo '|'; } ?>"			class="small-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Seperator between next and last</label><br/>
						<label><input type="text"		name="cms_nav_paged_num_pages"	value="<?php if (!empty($cms_options['nav_paged_num_pages'])){	echo $cms_options['nav_paged_num_pages']; } else {	echo '10'; } ?>"		class="small-text"<?php if (!$cms_options['nav_paged']){ echo $dis; } ?>/> Number of pages to display</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_content-posts">Content Posts</strong><br/>
						Generate content for <a href="http://codex.wordpress.org/Glossary#Slug">slug</a>(s) archive, categories, tags, authors &amp; search</th><td>
<!--					<label><input type="checkbox"	name="cms_posts_date_images"	value="true"<?php if ($cms_options['posts_date_images']){ echo $chk; } ?>/> Use post date images (fancy dates)</label><br/> -->
						<label><input type="checkbox"	name="cms_posts_user_based"		value="true"<?php if ($cms_options['posts_user_based']){ echo $chk; } ?>/> Display user specific blog posts based on categories</label><br/>
						<label><input type="checkbox"	name="cms_posts_excerpt"		value="true"<?php if ($cms_options['posts_excerpt']){ echo $chk; } ?>/> Use &ldquo;the_excerpt()&rdquo; on archive &amp; search pages</label><br/>
							This removes links and images from the post content while viewing archive (dates/categories/tags/authors) &amp; search pages.<br/>
						<label><input type="checkbox"	name="cms_posts_archive"		value="true"<?php if ($cms_options['posts_archive']){ echo $chk; } ?>/> Generate content for &ldquo;special&rdquo; post page(s) *</label><br/>
							* this is experimental &amp; not fully implemented.<br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_content-pages">Content Pages</strong><br/>
						Generate content for <a href="http://codex.wordpress.org/Glossary#Slug">slug</a>(s) site-map, links &amp; contact</th><td>
						<label><input type="text"		name="cms_pages_img"			value="<?php echo str_replace(',', ', ', trim($cms_options['pages_img'])); ?>" class="regular-text"/><br/>
							Include &quot;#left&quot; markup on these page(s)</label><br/>
						<label><input type="checkbox"	name="cms_pages_site-map"		value="true"<?php if ($cms_options['pages_site-map']){ echo $chk; } ?>/> Generate Site Map</label><br/>
						<label><input type="checkbox"	name="cms_pages_links"			value="true"<?php if ($cms_options['pages_links']){ echo $chk; } ?>/> Generate Links Page *</label><br/>
						<label><input type="checkbox"	name="cms_pages_contact_form"	value="true"<?php if ($cms_options['pages_contact_form']){ echo $chk; } ?>/> Generate Contact Form *</label><br/>
						<label><input type="checkbox"	name="cms_pages_contact_map"	value="true"<?php if ($cms_options['pages_contact_map']){ echo $chk; } ?>/> Generate Contact Google Map</label> (See <a href="#cms_google">configuration</a> below)<br/>
						* this is experimental &amp; not fully implemented.<br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_content-pages">Comments</strong></th><td>
						<label><input type="checkbox"	name="cms_comments_posts"		value="true"<?php if ($cms_options['comments_posts']){ echo $chk; } ?>/> Disable post comments globally</label><br/>
						<label><input type="checkbox"	name="cms_comments_pages"		value="true"<?php if ($cms_options['comments_pages']){ echo $chk; } ?>/> Disable page comments globally</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_sidebars">Sidebars</strong><br/>
						Generate sidebars:<br/>
						General Page(s) &amp; Post Page <?php if ($pge_posts_title){ echo '&ldquo;<em>'.$pge_posts_title.'</em>&rdquo; '; } ?>(Defined in the <a href="<?php echo $ste_url; ?>/wp-admin/options-reading.php">Reading Settings</a>)<br/>
						<br/>
						Sidebar(s) will appear on pages with matching &ldquo;<a href="http://codex.wordpress.org/Glossary#Slug">slug</a>(s)&rdquo; (and their children) </th><td>
						<label><input type="text"		name="cms_sidebars_dynamic"		value="<?php if (!empty($cms_options['sidebars_dynamic'])){ echo $cms_options['sidebars_dynamic']; } else { echo $pge_posts_title.', Pages'; if (function_exists('shopp')){ echo ', Shop'; } } ?>" class="regular-text"/><br/>
							Dynamic Sidebars - Comma seperated list of the sidebar names</label><br/>
							Append addtional sidebar names as required. For best results use top level pages.<br/>
						<label><input type="checkbox"	name="cms_sidebars_default"		value="true"<?php if ($cms_options['sidebars_default']){ echo $chk; } ?>/> Suppress default sidebar</label><br/>
						<p>[<em>Insert checkboxes to choose which items appear on default sidebar.</em>]</p>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_stylesheets">Stylesheets</strong> (css)</th><td>
						<label><input type="checkbox"	name="cms_css_slideshow"		value="true"<?php if ($cms_options['css_slideshow']){ echo $chk; } ?>/> Link slideshow.css</label><br/>
						<label><input type="checkbox"	name="cms_css_iconize"			value="true"<?php if ($cms_options['css_iconize']){ echo $chk; } ?>/> Link iconize.css - file &amp; external link icons</label><br/>
						<label><input type="checkbox"	name="cms_css_site-map"			value="true"<?php if ($cms_options['css_site-map']){ echo $chk; } ?>/> Link site-map.css (on <a href="http://codex.wordpress.org/Glossary#Slug">slug</a> &ldquo;site-map&rdquo; only)</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_javascript">Javascript</strong></th><td>
						<label><input type="checkbox"	name="cms_js_tinybox"			value="true"<?php if ($cms_options['js_tinybox']){ echo $chk; } ?>/> Link tinybox.js</label><br/><label><input type="checkbox"	name="cms_js_tinybox"			value="true"<?php if ($cms_options['js_tinybox']){ echo $chk; } ?>/> Link tinybox.js</label><br/>
						<label><input type="checkbox"	name="cms_js_tinyaccordion"		value="true"<?php if ($cms_options['js_tinyaccordion']){ echo $chk; } ?>/> Link tinyaccordion.js</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_jquery">jQuery</strong> (Javascript)<br/>
						Activate option(s) and save to enable additional settings.</th><td>
						<label><input type="checkbox"	name="cms_jquery"				value="true"<?php if ($cms_options['jquery']){ echo $chk; } ?>/> Link jquery.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_lightbox"		value="true"<?php if ($cms_options['jquery_lightbox']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link lightbox.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_thickbox"		value="true"<?php if ($cms_options['jquery_thickbox']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link thickbox.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_colorbox"		value="true"<?php if ($cms_options['jquery_colorbox']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link colorbox.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_innerfade"		value="true"<?php if ($cms_options['jquery_innerfade']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link innerfade.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_imageswitch"	value="true"<?php if ($cms_options['jquery_imageswitch']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link imageswitch.js</label><br/>
						<label><input type="checkbox"	name="cms_jquery_tabswitch"		value="true"<?php if ($cms_options['jquery_tabswitch']){ echo $chk; } ?><?php if (!$cms_options['jquery']){ echo $dis; } ?>/> Link tabswitch.js</label><br/>
<!--					Slideshow source code
						<label><input type="radio" name="cms_jquery_slideshow_type" value="hand coded"<?php if ($cms_options['jquery_slideshow']){ echo $chk; } ?><?php if (!$cms_options['jquery_slideshow']){ echo $dis; } ?>/> Hand Coded</label>
						<label><input type="radio"		name="cms_jquery_slideshow_type" value="generated"<?php if ($cms_options['jquery_slideshow']){ echo $chk; } ?><?php if (!$cms_options['jquery_slideshow']){ echo $dis; } ?>/> Generated</label><br/> -->
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_mootools">MooTools</strong> (Javascript)<br/>
						Activate option(s) and save to enable additional settings.</th><td>
						<label><input type="checkbox"	name="cms_mootools"				value="true"<?php if ($cms_options['mootools']){ echo $chk; } ?>/> Link mootools.js</label><br/>
<!--					<label><input type="checkbox"	name="cms_mootools_imagemenu" value="true"<?php if ($cms_options['mootools_imagemenu']){ echo $chk; } ?><?php if (!$cms_options['mootools']){ echo $dis; } ?>/> Link imagemenu.js</label><br/> -->
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_typeface">Typeface.js</strong> (Javascript)<br/>
						Activate option(s) and save to enable additional settings.<br/>
						<br/>
						Available faces:<br/>
						<em>Emblem, Eurose, Gentilis, Helvetiker, Optimer, Strasua, Verdana</em></th><td>
						<label><input type="checkbox"	name="cms_typeface"				value="true"<?php if ($cms_options['typeface']){ echo $chk; } ?>/> Link typeface.js (Requires at least one typeface)</label><br/>
						<label><input type="text"		name="cms_typeface_faces" 		value="<?php echo $cms_options['typeface_faces']; ?>" class="regular-text"<?php if (!$cms_options['typeface']){ echo $dis; } ?>/><br/>
							Typeface.js Faces - Comma seperated list of font family names</label><br/>
							Styles when available: <em>regular, italic, bold, bold italic</em><br/>
						<p>[<em>Insert checkboxes to choose which typefaces will be linked.</em>]</p>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_google">Google Services</strong></th><td>
						<label><input type="text"		name="cms_g_analytics_id"		value="<?php echo $cms_options['g_analytics_id']; ?>" class="medium-text"/> <a href="http://google.com/analytics">Google Analyitics</a> user number</label><br/>
						<label><input type="text"		name="cms_g_adsense_id"			value="<?php echo $cms_options['g_adsense_id']; ?>" class="medium-text"/> <a href="http://google.com/adsense">Google Adsense</a> user number</label><br/>
							* For manual implimentaions of Google Adsense. Additional settings will be required at point of function call.<br/>
						<label><input type="text"		name="cms_g_reader_id"			value="<?php echo $cms_options['g_reader_id']; ?>" class="medium-text"/> <a href="http://google.com/reader">Google Reader</a> user number</label><br/>
							* This option's implimentaion is unfinshed.<br/>
						<label><input type="text"		name="cms_g_maps_url"			value="<?php echo htmlentities($cms_options['g_maps_url']); ?>" class="regular-text"/> Maps URL</label><br/>
							This option is dependent upon activation of the &ldquo;Google Maps&rdquo; checkbox in section labeled <a href="#cms_content-pages">Generated Content</a> above.<br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_sites">Additional Sites</strong></th><td>
						<label><input type="checkbox"	name="cms_olark"				value="true"<?php if ($cms_options['olark']){ echo $chk; } ?>/> Use the <a href="http://olark.com/">Olark</a> service (Chat)</label><br/>
						<label><input type="text"		name="cms_olark_id"				value="<?php echo $cms_options['olark_id']; ?>" class="text"/> Olark User ID</label><br/>
						<label><input type="checkbox"	name="cms_addthis"				value="true"<?php if ($cms_options['addthis']){ echo $chk; } ?>/> Use the <a href="http://addthis.com/">AddThis</a> service (Sharing)</label><br/>
						<label><input type="text"		name="cms_addthis_id"			value="<?php echo $cms_options['addthis_id']; ?>" class="medium-text"/> AddThis User ID</label><br/>
						<label><textarea 				name="cms_addthis_services"		class="large-text code" cols="50" rows="3"><?php echo $cms_options['addthis_services']; ?></textarea><br/>
							AddThis &ldquo;options&rdquo; - Comma seperated list of services to display</label><br/>
					</td></tr>

					<tr valign="top"><th scope="row"><strong id="cms_misc">Miscellaneous</strong></th><td>
						<label><input type="checkbox"	name="cms_notice_ie6"			value="true"<?php if ($cms_options['notice_ie6']){ echo $chk; } ?>/> Display outdated browser notice for Internet Explorer 6 (IE6)</label><br/>
						<label><input type="checkbox"	name="cms_notice_ie7"			value="true"<?php if ($cms_options['notice_ie7']){ echo $chk; } ?>/> Display outdated browser notice for Internet Explorer 7 (IE7)</label><br/>
						<label><input type="checkbox"	name="cms_developer"			value="true"<?php if ($cms_options['developer']){ echo $chk; } ?>/> Surpress developer link in the footer</label><br/>
						<label><input type="checkbox"	name="cms_validation"			value="true"<?php if ($cms_options['validation']){ echo $chk; } ?>/> Surpress validation links in the footer</label><br/>
						<label><input type="checkbox"	name="cms_rss"					value="true"<?php if ($cms_options['rss']){ echo $chk; } ?>/> Surpress rss links in the footer</label><br/>
						<label><input type="checkbox"	name="cms_dev_p2p"				value="true"<?php if ($cms_options['dev_p2p']){ echo $chk; } ?>/> Use point2point (p2p) as the developer</label><br/>
					</td></tr>

					</table>

				</div>
			</div><!--#post-body-->
		</div><!--#poststuff-->

	</form>

<?php
/* test form
			if ($_POST['ss_action'] == 'save'){
				$this->options["display_blog_title"] = isset($_POST['cp_displayblogtitle']) ? 1 : 0;
				$this->options["blog_title_color"] = $_POST['cp_blogtitlecolor'];
				update_option('themename', $this->options);
				echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 300px; margin-left: 20px"><p>Settings <strong>saved</strong>.</p></div>';
			}
			
			echo '<form action="" method="post" class="themeform">';
			echo '<input type="hidden" id="ss_action" name="ss_action" value="save">';
			echo '<input type="checkbox" name="cp_displayblogtitle" id="cp_displayblogtitle"'.($this->options["display_blog_title"] == 1 ? ' checked' : '').'/><label style="margin-left: 5px;" for="cp_displayblogtitle">Display Blog Title</label><br/>';
			echo 'Blog Title Color: <input class="widefat" style="text-align: right; width: 65px" name="cp_blogtitlecolor" id="cp_blogtitlecolor" type="text" value="'.$this->options["blog_title_color"].'"/>';
			echo '<p class="submit"><input type="submit" value="Save Changes" name="cp_save"/></p>';
			echo '</form>';*/
?>
</div><!--.wrap-->
<?php
		}
		
		function admin_options_2(){
			//	$base_name = plugin_basename('cms-pagination/pagenavi-options.php');
			//	$base_page = 'admin.php?page='.$base_name;
			$mode = trim($_GET['mode']);
			$cms_nav_settings = array('cms_nav_options');

			### Form Processing 
			// Update Options
			if(!empty($_POST['Submit'])){
				$cms_nav_options = array();
				$cms_nav_options['text_pages']		= addslashes($_POST['cms_nav_text_pages']);
				$cms_nav_options['text_current']	= addslashes($_POST['cms_nav_text_active']);
				$cms_nav_options['text_page']		= addslashes($_POST['cms_nav_text_page']);
				$cms_nav_options['text_first']		= addslashes($_POST['cms_nav_text_first']);
				$cms_nav_options['text_last']		= addslashes($_POST['cms_nav_text_last']);
				$cms_nav_options['text_next']		= addslashes($_POST['cms_nav_text_next']);
				$cms_nav_options['text_previous']	= addslashes($_POST['cms_nav_text_previous']);
				$cms_nav_options['text_sep_last']	= addslashes($_POST['cms_nav_sep_last']);
				$cms_nav_options['text_sep_first']	= addslashes($_POST['cms_nav_sep_first']);
				$cms_nav_options['num_pages']		= intval(trim($_POST['cms_nav_num_pages']));

				$update_cms_nav_queries				= array();
				$update_cms_nav_text				= array();
				$update_cms_nav_queries[]			= update_option('cms_nav_options', $cms_nav_options);
				$update_cms_nav_text				= 'CMS Pagination Options';

//				$i = 0;
//				$text = '';

				foreach($update_cms_nav_queries as $update_cms_nav_query){
					if($update_cms_nav_query){
						$text .= '<font color="green">'.$update_cms_nav_text.'</font><br/>';
					}
					$i++;
				}

				if(empty($text)){
					$text = '<font color="red">No '.$update_cms_nav_text.' Updated</font>';
				}
			}

			// Uninstall CMS Pagination
			if(!empty($_POST['do'])){
				switch($_POST['do']){
					case __('Uninstall CMS Pagination', 'wp-pagenavi') :
						if(trim($_POST['uninstall_cms_nav_yes']) == 'yes'){
							echo '<div id="message" class="updated fade">';
							echo '<p>';
							foreach($cms_nav_settings as $setting){
								$delete_setting = delete_option($setting);
								if($delete_setting){
									echo '<font color="green">';
									printf(__('Setting Key \'%s\' has been deleted.', 'wp-pagenavi'), "<strong><em>{$setting}</em></strong>");
									echo '</font><br/>';
								} else {
									echo '<font color="red">';
									printf(__('Error deleting Setting Key \'%s\'.', 'wp-pagenavi'), "<strong><em>{$setting}</em></strong>");
									echo '</font><br/>';
								}
							}
							echo '</p>';
							echo '</div>'; 
							$mode = 'end-UNINSTALL';
						}
					break;
				}
			}

			### Determines Which Mode It Is
			switch($mode){
				//  Deactivating WP-PageNavi
				case 'end-UNINSTALL':
					$deactivate_url = 'plugins.php?action=deactivate&amp;plugin=wp-pagenavi/wp-pagenavi.php';
					if(function_exists('wp_nonce_url')){ 
						$deactivate_url = wp_nonce_url($deactivate_url, 'deactivate-plugin_wp-pagenavi/wp-pagenavi.php');
					}
?>
	<h2>Uninstall CMS Pagination</h2>
	<p><strong><?php sprintf(__('<a href="%s">Click Here</a> To Finish The Uninstallation And WP-PageNavi Will Be Deactivated Automatically.', 'wp-pagenavi'), $deactivate_url); ?></strong></p>
<?php
				break;
				// Main Page
				default:
				$cms_nav_options = get_option('cms_nav_options');
		
				if(!empty($text)){
					echo '<!--last action--><div id="message" class="updated fade"><p>'.$text.'</p></div>';
				}
?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 

		<h2>CMS Pagination</h2>
		<h3>Pagination Text</h3>

		<p>[T] - Total number of pages<br/>
			[A] - Active page number<br/>
			[P] - Page number</p>

		<label><input type="text"	name="cms_nav_text_pages"	size="20"	value="<?php echo stripslashes($cms_nav_options['text_pages']); ?>"/> Text For Number Of Pages</label><br/>
		<label><input type="text"	name="cms_nav_text_page"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_page'])); ?>"/> Text for each page</label><br/>
		<label><input type="text"	name="cms_nav_text_active"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_current'])); ?>"/> Text for active page</label><br/>
		<label><input type="text"	name="cms_nav_text_previous" size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_previous'])); ?>"/> Text for previous page</label><br/>
		<label><input type="text" 	name="cms_nav_text_next"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_next'])); ?>"/> Text for next page</label><br/>
		<label><input type="text"	name="cms_nav_text_first"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_first'])); ?>"/> Text for first page</label><br/>
		<label><input type="text"	name="cms_nav_text_last"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_last'])); ?>"/> Text for last page</label><br/>
		<label><input type="text"	name="cms_nav_sep_first"	size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_sep_first'])); ?>"/> Seperator between first and next</label><br/>
		<label><input type="text"	name="cms_nav_sep_last"		size="20"	value="<?php echo stripslashes(htmlspecialchars($cms_nav_options['text_sep_last'])); ?>"/> Seperator between previous and last</label><br/>
		<label><input type="text"	name="cms_nav_num_pages"	size="4"	value="<?php echo stripslashes($cms_nav_options['num_pages']); ?>"/> Number of pages to display</label><br/>

		<p class="submit"><input type="submit" name="Submit" class="button" value="Save Changes"/></p>

	</form> 

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	
		<h3>Uninstall CMS Pagination</h3>
		<p>WARNING: Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.</p>
		<p>The following WordPress Options will be DELETED:<br/>
<?php 
				foreach($cms_nav_settings as $settings){
					echo $settings.PHP_EOL;
				}
?></p>
		<label><input type="checkbox" name="cms_nav_uninstall" value="yes"/> Confirm uninstallation</label>
		<p><input type="submit" name="do" class="button" value="Uninstall"/></p>

	</form>
<?php
			}
		} // admin_options_2()
	} // class options
?>
