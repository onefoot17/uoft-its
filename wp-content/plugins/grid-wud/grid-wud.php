<?php
/*
=== Grid WUD ===
Contributors: wistudat.be
Plugin Name: Grid WUD
Donate Reason: Stand together to help those in need!
Donate link: https://www.icrc.org/eng/donations/
Description: WP Tiles WUD & Grid WUD adds responsive, customizable and dynamic grids, tiles, tables, galleries & widgets. Now with Woocommerce integration!
Author: Danny WUD
Author URI: https://wud-plugins.com
Plugin URI: https://wud-plugins.com
Tags: grid, grids, tile, tiles, woocommerce
Requires at least: 3.6
Tested up to: 4.8
Stable tag: 2.2.2
Version: 2.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: grid-wud
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	global $gwfuncs, $Grid_WUD_version, $pagenow;
//########################################################
$Grid_WUD_version='2.2.2';
//########################################################
	define( 'GRID_WUD_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WUD_GRID_URL', plugins_url( __FILE__ ) );
// grid-wud Actions
	//Admin menu (load always)
	add_action('admin_enqueue_scripts', 'grid_wud_style_more');
	add_action('admin_menu', 'grid_wud_submenu_page');
	add_filter( 'plugin_action_links', 'grid_wud_action_links', 10, 5 );
	add_action('init', 'grid_wud_mce_button');	
	// Filter Functions with Hooks
	function grid_wud_mce_button() {
	  // Check if user have permission
	  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	  }
	  if ( get_user_option( 'rich_editing' ) !== 'true' ) {
		return;
	  }
		add_filter( 'mce_external_plugins', 'grid_wud_tinymce_button' );
		add_filter( 'mce_buttons', 'grid_wud_register_mce_button' );		
	}
	
		add_action( 'admin_footer', 'grid_wud_cpt_list_cat_array' );
		add_action( 'admin_footer', 'grid_wud_cpt_list_tag_array' );	
		add_action( 'admin_footer', 'grid_wud_cpt_list_all_array' );		
		add_action( 'admin_footer', 'grid_wud_cpt_list_catwud_array' );	
		add_action( 'admin_footer', 'grid_wud_cpt_list_tagwud_array' );	
		add_action( 'admin_footer', 'grid_wud_cpt_list_woo_array' );
		add_action( 'admin_footer', 'grid_wud_cpt_list_woofeat_array' );		
		add_action( 'admin_footer', 'grid_wud_cpt_list_woocat_array' );
		add_action( 'admin_footer', 'grid_wud_cpt_list_wootag_array' );	
		add_action( 'admin_footer', 'grid_wud_cpt_list_tax_array' );		

	
	// Do not load unless its needed!
	if ( $pagenow !== 'index.php' && $pagenow !== 'admin.php' && $pagenow !== 'grid-wud-xtra.php' && $pagenow !== 'grid-wud-groups.php') {return; }	
	//Site
	add_shortcode( 'gridwud', 'grid_wud_comm' );
	add_action( 'wp_enqueue_scripts', 'grid_wud_styles' );
	add_action('plugins_loaded', 'grid_wud_languages');
	add_action( 'plugins_loaded', 'grid_wud_admin' );
	add_action( 'plugins_loaded', 'grid_wud_base' );
	add_action( 'plugins_loaded', 'grid_wud_banner' );	
	add_action( 'init', 'grid_wud_funcs' );
	register_activation_hook( __FILE__, 'grid_wud_activate' );
	//Add short code to widgets
	add_filter( 'widget_text', 'wud_widget_text', 1, 1);
	//Debug used template file
	add_action('wp_head', 'show_template');

	
	grid_wud_funcs();
	
// Store the latest version and update new fields.
	if (get_option('grid_wud_version') != $Grid_WUD_version) {
		grid_wud_activate();
		grid_wud_update();
	}			
// WUD GRID GALLERY 	
	if($gwfuncs['grid_wud_act_gallery']=='1'){
		add_action( 'plugins_loaded', 'grid_wud_gallery' );
		add_action( 'after_setup_theme', 'grid_wud_galleries' );
		}

		
//Debug used template file	
function show_template() {
    global $template;
    $temp = basename($template);
	//echo $temp;	
}
		
//WUD GRID WIDGET STYLE		
function wud_widget_text( $widget_text ){
		global $gwfuncs, $grid_wud_widget;
        $tag = 'gridwud';
        if ( isset($widget_text) && (has_shortcode( $widget_text, $tag )) )
            $grid_wud_widget=1;
        else
            $grid_wud_widget=0;
        return $widget_text;
}
	
// grid-wud-remove-original-wp-gallery, if WUD GRID GALLERY is activated
function grid_wud_gallery() {
		remove_shortcode( 'gallery' );
		add_shortcode('gallery', 'wud_grid_gallery');  
}
	
// grid-wud style, called from short code
function grid_wud_current_style() {
		global $gwfuncs;
		if($gwfuncs['grid_wud_my_css']=="grid-wud"){return $todo = 1;}
		if($gwfuncs['grid_wud_my_css']=="grid-wud-square"){return $todo = 2;}	
		if($gwfuncs['grid_wud_my_css']=="grid-wud-blocks"){return $todo = 3;}		
		if($gwfuncs['grid_wud_my_css']=="grid-wud-circle"){return $todo = 4;}		
		if($gwfuncs['grid_wud_my_css']=="grid-wud-photos"){return $todo = 5;}	
		if($gwfuncs['grid_wud_my_css']=="grid-wud-horizon"){return $todo = 6;}	
		if($gwfuncs['grid_wud_my_css']=="grid-wud-mixed"){return $todo = 7;}
		if($gwfuncs['grid_wud_my_css']=="grid-wud-mixed2"){return $todo = 8;}
		//IF MORE ... CHANGE in grid-wud-base.php MAX VALUE from $gwfuncs['gwcss'] !!!
		else{return $todo = 1;}
}

// grid-wud style
function grid_wud_styles() {	
		global $gwfuncs, $color, $post, $wp_version ;	
	
	//ONLY USED BY THE DEMO PAGE FROM WUD
	if($post){
		$post_slug=$post->post_name; $color=0;
		if ($post_slug=='wp-tiles-wud-with-sidebar' || $post_slug=='wud-gallery-sample' || $post_slug=='tiles-wud' || $post_slug=='wp-multi-tab-grid-wud'){
			$color=1;
		}
		else{
			$color=0;
		}	
	}

	//Load the grids and tiles CSS
	 wp_register_style( 'grid_wud_basic', plugins_url('css/grid-wud-base.css', __FILE__ ), false, null );
	 wp_enqueue_style( 'grid_wud_basic' );
	 wp_register_style( 'grid_wud_style_grids', plugins_url('css/grid-wud.css', __FILE__ ), false, null );
	 wp_enqueue_style( 'grid_wud_style_grids' );
	 wp_register_style( 'grid_wud_style_tiles', plugins_url('css/tiles-wud.css', __FILE__ ), false, null );
	 wp_enqueue_style( 'grid_wud_style_tiles' );
	 wp_register_style( 'grid_wud_banner', plugins_url('css/grid-wud-slider.css', __FILE__ ), false, null );
	 wp_enqueue_style( 'grid_wud_banner' );	 
	 
	 //Optional CSS 
	 wp_register_style( 'grid_wud_style_hover', plugins_url('css/grid-wud-base-hover.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_img_hover']=='1'){
		 wp_enqueue_style( 'grid_wud_style_hover' );
	 }
	 wp_register_style( 'grid_wud_style_center', plugins_url('css/grid-wud-title-center.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_title_pos']=='1'){
		 wp_enqueue_style( 'grid_wud_style_center' );
	 }	
	 wp_register_style( 'grid_wud_style_right', plugins_url('css/grid-wud-title-right.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_title_pos']=='2'){
		 wp_enqueue_style( 'grid_wud_style_right' );
	 }
	 wp_register_style( 'grid_wud_style_top', plugins_url('css/grid-wud-title-top.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_title_topmid']=='1'){
		 wp_enqueue_style( 'grid_wud_style_top' );
	 }
	 wp_register_style( 'grid_wud_style_mid', plugins_url('css/grid-wud-title-mid.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_title_topmid']=='2'){
		 wp_enqueue_style( 'grid_wud_style_mid' );
	 }
	 wp_register_style( 'grid_wud_style_over', plugins_url('css/grid-wud-title-over.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_title_topmid']=='3'){
		 wp_enqueue_style( 'grid_wud_style_over' );
	 }	 
	 wp_register_style( 'grid_wud_style_grey', plugins_url('css/grid-wud-base-grey.css', __FILE__ ), false, null );
	 if($gwfuncs['grid_wud_img_grey']=='1' && $color==0){
		 wp_enqueue_style( 'grid_wud_style_grey' );
	 }	 
	 
	// Javascript read more page.
	// Befor WP 3.6.0 JQUERY is not loaded.
	  if ($wp_version < '3.6.0' ||  ! wp_script_is( 'jquery', 'enqueued' )){
	  wp_enqueue_script('jquery');
	  }
	  wp_register_script('grid_wud_script', plugins_url( 'js/grid-wud.js', __FILE__ ), array('jquery'), null, true );
	  wp_enqueue_script('grid_wud_script');

	  wp_register_script('group_wud_script', plugins_url( 'js/grid-wud-group.js', __FILE__ ), array('jquery'), null, true );
	  wp_enqueue_script('group_wud_script');    	  
	  
	// Fade out/in option	  
	if (get_option('grid_wud_fade_in')=='1'){
	  wp_register_script('grid_wud_fade', plugins_url( 'js/grid-wud-fade.js', __FILE__ ), array('jquery'), null, true );
	  wp_enqueue_script('grid_wud_fade');
	} 
		  
	// WUD Light Box option for gallery	  
	if (get_option('grid_wud_lb_gallery')=='1'){
	  wp_register_script('grid_wud_light_box', plugins_url( 'js/grid-wud-lightbox.js', __FILE__ ), array('jquery'), null, true );
	  wp_enqueue_script('grid_wud_light_box');
	} 

	// WUD Light Box option	for grids/tiles  
	//if (get_option('grid_wud_popup')=='1'){
	  wp_register_script('grid_tiles_light_box', plugins_url( 'js/grid-tiles-lightbox.js', __FILE__ ), array('jquery'), null, true );
	  wp_enqueue_script('grid_tiles_light_box');
	//}
	
	//Extra grid button result
	  wp_localize_script('grid_wud_script', 'grid_wud_php', array('grid_wud_url' => plugins_url( 'pages/grid-wud-xtra.php', __FILE__ ),));

	//Extra grid group result
	  wp_localize_script('group_wud_script', 'group_wud_php', array('group_wud_url' => plugins_url( 'pages/grid-wud-groups.php', __FILE__ ),));	  
 }
	
// grid-wud languages
function grid_wud_languages() {
	load_plugin_textdomain( 'grid-wud', false, dirname(plugin_basename( __FILE__ ) ) . '/languages' );
}

// grid-wud options page (settings menu option)
function grid_wud_submenu_page() {
	add_menu_page( 'Grid WUD', 'Grid WUD EOL', 'manage_options', 'grid-wud', 'grid_wud_options_notice', plugins_url('images/wud_icon.png', __FILE__ ) );
}

// grid-wud options page (menu options by plugins)
function grid_wud_action_links( $actions, $grid_wud_set ){
	static $plugin;
	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	if ($plugin == $grid_wud_set) {
		$settings_page = array('settings' => '<a href="admin.php?page=grid-wud">' . __('Settings', 'General') . '</a>');
		$support_link = array('support' => '<a href="https://wordpress.org/support/plugin/grid-wud" target="_blank">Support</a>');				
		$actions = array_merge($support_link, $actions);
		$actions = array_merge($settings_page, $actions);
	}			
	return $actions;
}

// Color picker and media uploader for admin
function grid_wud_style_more($hook) {
	if   ( $hook == "toplevel_page_grid-wud" ) {	
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style( 'cs-wp-color-picker', plugins_url( 'css/cs-wp-color-picker.css', __FILE__ ), array( 'wp-color-picker' ), null, 'all' );
		wp_enqueue_style( 'grid_wud_admin_style' );
		wp_enqueue_style( 'grid_wud_admin_style', plugins_url('css/admin.css', __FILE__ ), false, null );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'cs-wp-color-picker', plugins_url( 'js/cs-wp-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), null, true );	
		wp_enqueue_media();
		wp_register_script( 'media-grid-uploader-js', plugins_url( 'js/admin_script.js' , __FILE__ ), array('jquery') );
		wp_enqueue_script( 'media-grid-uploader-js' );	
     }
}

// Search the image in the database
function wud_get_image_id($image_url) {
	global $wpdb;
	//If size is included in the URL, try to remove it!
		$str = substr(strrchr($image_url, '.'), 1);
		$extention=strlen($str)+1;
		$tmp_url = substr(substr($image_url, strrpos($image_url, '-') + 1), 0, -$extention);								
			if (strpos($tmp_url, 'x') !== false) {
				$new_name = "-".substr(substr($image_url, strrpos($image_url, '-') + 1), 0, -$extention);
				$image_url=str_replace($new_name,"",$image_url);
			}
	//Search attachment ID without size in the URL
		$wud_attach = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE '%s';", '%'.$image_url.'%'
			)
		);	
		if(!empty($wud_attach[0])){
			return $wud_attach[0]; 
			}
	//If the image was not found, return value 0, for default image view
			return 0;
}

// Comma separated values to array
function ctoarray($string, $separator = ',')
{
  $vals = explode($separator, $string);
  foreach($vals as $key => $val) {
    $vals[$key] = trim($val);
  }
  return array_diff($vals, array(""));
}

//Change HEX to RGBA colors
function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color))
          return $default; 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
}

//Get used image sizes
function get_image_sizes() {
	global $_wp_additional_image_sizes;
	$sizes = array();
	$si=0;
	//Unset double unused array() keys
	$imgsizes = get_intermediate_image_sizes();
	  foreach($imgsizes as $key => $value) {
		foreach($imgsizes as $key2 => $value2) {
		  if($key != $key2 && $value === $value2) {
			unset($imgsizes[$key]);
		  }
		}
	  }
	//Collect the size data
	foreach ( $imgsizes as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			if(get_option( "{$_size}_size_w" )>0 && get_option( "{$_size}_size_h" )>0){
			$sizes[ $_size ][ 'id' ]  = $si;
			$sizes[ $_size ][ 'size']  = get_option( "{$_size}_size_w" )."*".get_option( "{$_size}_size_h" );
			}
		} 
		elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			if($_wp_additional_image_sizes[ $_size ]['width']>0 && $_wp_additional_image_sizes[ $_size ]['height']>0){
			$sizes[ $_size ] = array(
				'id'  => $si,
				'size' => $_wp_additional_image_sizes[ $_size ]['width']."*".$_wp_additional_image_sizes[ $_size ]['height']." = ".__('CUSTOM SIZE', 'grid-wud')."!",
			);	
			
			}
		}
					$si++;
	}	
	$ad_original = array('full sized' => array ( 'id' => 'X' ,'size' => 'Original' ));
	$sizes = $sizes + $ad_original;
	return $sizes;
}

// Update optional image size, by install or update	
function grid_image_size(){
	  global $gwfuncs, $_wp_additional_image_sizes;
		grid_wud_funcs();
		$thumbs =get_image_sizes();
		$found = false;
		//IMAGE SIZE
		foreach ($thumbs as $key => $data) {
			if ($data['id'] == $gwfuncs['grid_wud_thumb_img']) {
				$found = true;
				break;
			}
		}	
			if($found==false){
				update_option('grid_wud_thumb_img', "X");
				grid_wud_funcs();
			}
		//GALLERY SIZE
		$found = false;
		foreach ($thumbs as $key => $data) {
			if ($data['id'] == $gwfuncs['grid_wud_thumb_gallery']) {
				$found = true;
				break;
			}
		}	
			if($found==false){
				update_option('grid_wud_thumb_gallery', "X");
				grid_wud_funcs();
			}						
}
	
//Load extra grid page  
function grid_wud_admin() {
	require_once( GRID_WUD_DIR . '/pages/grid-wud-admin.php' );
}
	
//Load base grid page
function grid_wud_base() {
	require_once( GRID_WUD_DIR . '/pages/grid-wud-base.php' );
}

//Load gallery grid page
function grid_wud_galleries() {
	require_once( GRID_WUD_DIR . '/pages/grid-wud-gallery.php' );
}
	
//Load banner page
function grid_wud_banner() {
	require_once( GRID_WUD_DIR . '/pages/grid-wud-banner.php' );
}

// New fields from version 1.0.5 on 
function grid_wud_update(){
		global $Grid_WUD_version;
			//Update optional image size if not found.
			grid_image_size();
			//Update version number
			update_option('grid_wud_version', $Grid_WUD_version);
}
	
//Declare once all Grid WUD settings 	
function grid_wud_funcs(){
		//Set it global
		global $gwfuncs;
		//Remember the settings (output=$gwfuncs['grid_wud_my_css'];)
		//gwcss is used to switch the grid style
		$gwfuncs = array(
			'gwcss' => '0',
			'grid_wud_my_css' => get_option('grid_wud_my_css'),
			'grid_wud_cat_bcolor' => get_option('grid_wud_cat_bcolor'),
			'grid_wud_cat_fcolor' => get_option('grid_wud_cat_fcolor'),
			'grid_wud_h1_font_size' => get_option('grid_wud_h1_font_size'),
			'grid_wud_set_featured_img' => get_option('grid_wud_set_featured_img'),
			'grid_wud_set_max_grid' => get_option('grid_wud_set_max_grid'),
			'grid_wud_set_more_grid' => get_option('grid_wud_set_more_grid'),
			'grid_wud_hide_cat_tag_header' => get_option('grid_wud_hide_cat_tag_header'),
			'grid_wud_hide_grid_cat' => get_option('grid_wud_hide_grid_cat'),
			'grid_wud_show_excerpt' => get_option('grid_wud_show_excerpt'),
			'grid_wud_show_arch_button' => get_option('grid_wud_show_arch_button'),
			'grid_wud_show_grid_button' => get_option('grid_wud_show_grid_button'),
			'grid_wud_show_arch_grid' => get_option('grid_wud_show_arch_grid'),
			'grid_wud_set_order_grid' => get_option('grid_wud_set_order_grid'),
			'grid_wud_set_dir_grid' => get_option('grid_wud_set_dir_grid'),
			'grid_wud_but_bcolor' => get_option('grid_wud_but_bcolor'),
			'grid_wud_but_fcolor' => get_option('grid_wud_but_fcolor'),
			'grid_wud_but_font_size' => get_option('grid_wud_but_font_size'),
			'grid_wud_size_excerpt' => get_option('grid_wud_size_excerpt'),
			'grid_wud_excerpt_words' => get_option('grid_wud_excerpt_words'),
			'grid_wud_fade_in' => get_option('grid_wud_fade_in'),
			'grid_wud_skip_post' => get_option('grid_wud_skip_post'),
			'grid_wud_version' => get_option('grid_wud_version'),
			'grid_wud_cpt01' => get_option('grid_wud_cpt01'),
			'grid_wud_cpt02' => get_option('grid_wud_cpt02'),
			'grid_wud_def_img' => get_option('grid_wud_def_img'),
			'grid_wud_def_jq' => get_option('grid_wud_def_jq'),
			'grid_wud_slider' => get_option('grid_wud_slider'),
			'grid_wud_img_hover' => get_option('grid_wud_img_hover'),
			'grid_wud_img_grey' => get_option('grid_wud_img_grey'),
			'grid_wud_img_split' => get_option('grid_wud_img_split'),
			'grid_wud_size_split' => get_option('grid_wud_size_split'),
			'grid_wud_rev_back' => get_option('grid_wud_rev_back'),
			'grid_wud_round_img' => get_option('grid_wud_round_img'),
			'grid_wud_round_index' => get_option('grid_wud_round_index'),
			'grid_wud_round_button' => get_option('grid_wud_round_button'),
			'grid_wud_font_header' => get_option('grid_wud_font_header'),
			'grid_wud_hide_button' => get_option('grid_wud_hide_button'),
			'grid_wud_font_excerpt' => get_option('grid_wud_font_excerpt'),
			'grid_wud_font_button' => get_option('grid_wud_font_button'),
			'grid_wud_title_pos' => get_option('grid_wud_title_pos'),
			'grid_wud_title_topmid' => get_option('grid_wud_title_topmid'),
			'grid_wud_cat_url' => get_option('grid_wud_cat_url'),
			'grid_wud_news_title' => get_option('grid_wud_news_title'),
			'grid_wud_nourl' => get_option('grid_wud_nourl'),
			'grid_wud_popup' => get_option('grid_wud_popup'),
			'grid_wud_container_pos' => get_option('grid_wud_container_pos'),
			'grid_wud_shadow' => get_option('grid_wud_shadow'),
			'grid_wud_act_gallery' => get_option('grid_wud_act_gallery'),
			'grid_wud_url_gallery' => get_option('grid_wud_url_gallery'),
			'grid_wud_lb_gallery' => get_option('grid_wud_lb_gallery'),
			'grid_wud_thumb_gallery' => get_option('grid_wud_thumb_gallery'),
			'grid_wud_thumb_img' => get_option('grid_wud_thumb_img'),
			'grid_wud_width' => get_option('grid_wud_width'),
			'grid_wud_width_px' => get_option('grid_wud_width_px'),
			'grid_wud_bgc1' => get_option('grid_wud_bgc1'),
			'grid_wud_bgc2' => get_option('grid_wud_bgc2'),
			'grid_wud_bgc3' => get_option('grid_wud_bgc3'),
			'grid_wud_bgc4' => get_option('grid_wud_bgc4'),
			'grid_wud_bgc5' => get_option('grid_wud_bgc5'),
			'wud_master_key' => get_option('wud_master_key')
			);
			return $gwfuncs;
}	
	
		
	
//Standard values only inserted on activation.
function grid_wud_activate() {		
		if (get_option('grid_wud_my_css')=='') {update_option('grid_wud_my_css', 'grid-wud');}
		if (get_option('grid_wud_cat_bcolor')=='') {update_option('grid_wud_cat_bcolor', '#929292');}
		if (get_option('grid_wud_cat_fcolor')=='') {update_option('grid_wud_cat_fcolor', '#FFF');}
		if (get_option('grid_wud_h1_font_size')=='') {update_option('grid_wud_h1_font_size', '1.2');}
		if (get_option('grid_wud_set_featured_img')=='') {update_option('grid_wud_set_featured_img', 1);}
		if (get_option('grid_wud_set_max_grid')=='') {update_option('grid_wud_set_max_grid', 5);}
		if (get_option('grid_wud_set_more_grid')=='') {update_option('grid_wud_set_more_grid', 2);}
		if (get_option('grid_wud_hide_cat_tag_header')=='') {update_option('grid_wud_hide_cat_tag_header', 0);}
		if (get_option('grid_wud_hide_grid_cat')=='') {update_option('grid_wud_hide_grid_cat', 0);}
		if (get_option('grid_wud_show_excerpt')=='') {update_option('grid_wud_show_excerpt', 2);}
		if (get_option('grid_wud_show_arch_button')=='') {update_option('grid_wud_show_arch_button', 'Read More ...');}
		if (get_option('grid_wud_show_grid_button')=='') {update_option('grid_wud_show_grid_button', 'Read More ...');}
		if (get_option('grid_wud_show_arch_grid')=='') {update_option('grid_wud_show_arch_grid', 0);}
		if (get_option('grid_wud_set_order_grid')=='') {update_option('grid_wud_set_order_grid', 'date');}
		if (get_option('grid_wud_set_dir_grid')=='') {update_option('grid_wud_set_dir_grid', 'DESC');}
		if (get_option('grid_wud_but_bcolor')=='') {update_option('grid_wud_but_bcolor', '#dd5252');}
		if (get_option('grid_wud_but_fcolor')=='') {update_option('grid_wud_but_fcolor', '#FFF');}
		if (get_option('grid_wud_but_font_size')=='') {update_option('grid_wud_but_font_size', '1.0');}
		if (get_option('grid_wud_size_excerpt')=='') {update_option('grid_wud_size_excerpt', '12');}
		if (get_option('grid_wud_excerpt_words')=='') {update_option('grid_wud_excerpt_words', 25);}
		if (get_option('grid_wud_skip_post')=='') {update_option('grid_wud_skip_post', 0);}
		if (get_option('grid_wud_fade_in')=='') {update_option('grid_wud_fade_in', 1);}
		if (get_option('grid_wud_cpt01')=='') {update_option('grid_wud_cpt01', 'Custom Post Type 01');}
		if (get_option('grid_wud_cpt02')=='') {update_option('grid_wud_cpt02', 'Custom Post Type 02');}
		if (get_option('grid_wud_def_img')=='') {update_option('grid_wud_def_img', plugins_url('images/empty-grid.png', __FILE__ ));}
		if (get_option('grid_wud_def_jq')=='') {update_option('grid_wud_def_jq', plugins_url('js/grid-tiles-lightbox.js', __FILE__ ));}
		if (get_option('grid_wud_slider')=='') {update_option('grid_wud_slider', plugins_url('js/grid-wud-slider.js', __FILE__ ));}
		if (get_option('grid_wud_img_hover')=='') {update_option('grid_wud_img_hover', 1);}
		if (get_option('grid_wud_img_grey')=='') {update_option('grid_wud_img_grey', 0);}
		if (get_option('grid_wud_img_split')=='') {update_option('grid_wud_img_split', 0);}
		if (get_option('grid_wud_size_split')=='') {update_option('grid_wud_size_split', 0);}
		if (get_option('grid_wud_rev_back')=='') {update_option('grid_wud_rev_back', 0);}
		if (get_option('grid_wud_round_img')=='') {update_option('grid_wud_round_img', 0);}
		if (get_option('grid_wud_round_index')=='') {update_option('grid_wud_round_index', 1);}
		if (get_option('grid_wud_round_button')=='') {update_option('grid_wud_round_button', 4);}
		if (get_option('grid_wud_font_header')=='') {update_option('grid_wud_font_header', 'inherit');}
		if (get_option('grid_wud_hide_button')=='') {update_option('grid_wud_hide_button', '2');}
		if (get_option('grid_wud_font_excerpt')=='') {update_option('grid_wud_font_excerpt', 'inherit');}
		if (get_option('grid_wud_font_button')=='') {update_option('grid_wud_font_button', 'inherit');}
		if (get_option('grid_wud_title_pos')=='') {update_option('grid_wud_title_pos', 0);}
		if (get_option('grid_wud_cat_url')=='') {update_option('grid_wud_cat_url', 0);}
		if (get_option('grid_wud_news_title')=='') {update_option('grid_wud_news_title', 'Latest News');}
		$permalink = get_option('permalink_structure');
		if($permalink !== "/%category%/%postname%/" || $permalink !== "/%postname%/"){
			if (get_option('grid_wud_nourl')=='') {update_option('grid_wud_nourl', 2);}
		}
		else{
			if (get_option('grid_wud_nourl')=='') {update_option('grid_wud_nourl', 0);}
		}	
		if (get_option('grid_wud_popup')=='') {update_option('grid_wud_popup', 0);}		
		if (get_option('grid_wud_container_pos')=='') {update_option('grid_wud_container_pos', 0);}
		if (get_option('grid_wud_shadow')=='') {update_option('grid_wud_shadow', 1);}
		if (get_option('grid_wud_act_gallery')=='') {update_option('grid_wud_act_gallery', 0);}
		if (get_option('grid_wud_url_gallery')=='') {update_option('grid_wud_url_gallery', 1);}
		if (get_option('grid_wud_lb_gallery')=='') {update_option('grid_wud_lb_gallery', 0);}
		if (get_option('grid_wud_thumb_gallery')=='') {update_option('grid_wud_thumb_gallery', 0);}
		if (get_option('grid_wud_thumb_img')=='') {update_option('grid_wud_thumb_img', 'X');}
		if (get_option('grid_wud_width')=='') {update_option('grid_wud_width', 100);}
		if (get_option('grid_wud_width_px')=='') {update_option('grid_wud_width_px', 800);}
		if (get_option('grid_wud_bgc1')=='') {update_option('grid_wud_bgc1', "#fff");}
		if (get_option('grid_wud_bgc2')=='') {update_option('grid_wud_bgc2', "#ffffad");}
		if (get_option('grid_wud_bgc3')=='') {update_option('grid_wud_bgc3', "#cfffba");}
		if (get_option('grid_wud_bgc4')=='') {update_option('grid_wud_bgc4', "#c0e2f9");}
		if (get_option('grid_wud_bgc5')=='') {update_option('grid_wud_bgc5', "#ffc4c4");}
		if (get_option('wud_master_key')=='') {update_option('wud_master_key', "0");}
}

function grid_wud_cpt_list_cat_array() {
	$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
	
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_cat_array'>";	
	$showres .= "<input type='hidden' name='wud_cats' id='wud_cats' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}

function grid_wud_cpt_list_tag_array() {
	$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'post_tag',
	'pad_counts'               => false );
	
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_tag_array'>";	
	$showres .= "<input type='hidden' name='wud_tags' id='wud_tags' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}




//Search categories for grid-wud-button
function grid_wud_cpt_list_all_array() {
	global $wpdb;

    $list = array();
		$selected = '';
		$list[] = array(
			'text' =>	'Latest Post',
			'value'	=>	'wud-latest'
		);

	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_all_array'>";	
	$showres .= "<input type='hidden' name='wud_alle' id='wud_alle' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}

//Search all for grid-wud-button
function grid_wud_cpt_list_catwud_array( ) {
	if(get_option('cattopage_wud_unique')=="1"){
		$args = array(
		'type'                     => 'page',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'categories',
		'pad_counts'               => false );
	}
	else{
		$args = array(
		'type'                     => 'page',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false );		
	}
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_catwud_array'>";	
	$showres .= "<input type='hidden' name='wud_page_cat' id='wud_page_cat' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}


//Search all for grid-wud-button
function grid_wud_cpt_list_tagwud_array( ) {
	if(get_option('cattopage_wud_unique')=="1"){
		$args = array(
		'type'                     => 'page',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'tags',
		'pad_counts'               => false );
	}
	else{
		$args = array(
		'type'                     => 'page',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'post_tag',
		'pad_counts'               => false );		
	}	
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_tagwud_array'>";	
	$showres .= "<input type='hidden' name='wud_page_tag' id='wud_page_tag' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}

 
//Search all woocommerce for grid-wud-button
function grid_wud_cpt_list_woo_array( ) {
	global $wpdb;

    $list = array();
		$selected = '';
		$list[] = array(
			'text' =>	'All Products',
			'value'	=>	'woocommerce'
		);

	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_woo_array'>";	
	$showres .= "<input type='hidden' name='wud_woo_all' id='wud_woo_all' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}

 
//Search all woocommerce featured products for grid-wud-button
function grid_wud_cpt_list_woofeat_array( ) {
	global $wpdb;

    $list = array();
		$selected = '';
		$list[] = array(
			'text' =>	'Featured Products',
			'value'	=>	'woofeatured'
		);

	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_woofeat_array'>";	
	$showres .= "<input type='hidden' name='wud_woo_feat' id='wud_woo_feat' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}

//Search woocommerce categories for grid-wud-button
function grid_wud_cpt_list_woocat_array( ) {
	$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'product_cat',
	'pad_counts'               => false );
	
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_woocat_array'>";	
	$showres .= "<input type='hidden' name='wud_woo_cat' id='wud_woo_cat' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}


//Search woocommerce tags for grid-wud-button
function grid_wud_cpt_list_wootag_array( ) {
	$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'product_tag',
	'pad_counts'               => false );
	
	$cpt = get_categories( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->name;
		$cat_slug = $wud_cat->slug;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_wootag_array'>";	
	$showres .= "<input type='hidden' name='wud_woo_tag' id='wud_woo_tag' value='".json_encode($list)."'/>";
	$showres .= "</form>";
	echo $showres;
}



//Search taxonomy for grid-wud-button
function grid_wud_cpt_list_tax_array( ) {
	
	$categories_exist = taxonomy_exists('categories');
	$tags_exist = taxonomy_exists('tags');
	$product_cat_exist = taxonomy_exists('product_cat');
	$product_tag_exist = taxonomy_exists('product_tag');
	
	$taxo = array('category', 'post_tag');
	
	if($categories_exist=="True" && $tags_exist=="True"){$taxo = array('category', 'post_tag','categories', 'tags');}
	if($product_cat_exist=="True" && $product_tag_exist=="True"){$taxo = array('category', 'post_tag','product_cat', 'product_tag');}
	if($categories_exist=="True" && $tags_exist=="True" && $product_cat_exist=="True" && $product_tag_exist=="True"){$taxo = array('category', 'post_tag','categories', 'tags','product_cat', 'product_tag');}

	
	$args = array(
	'taxonomy'                 => $taxo,
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'pad_counts'               => false );
	
	$cpt = get_terms( $args );
	
    $list = array();
    foreach ( $cpt as $wud_cat ) {
		$selected = '';
		$cat_name = $wud_cat->slug;
		$cat_slug = $wud_cat->taxonomy;
		$list[] = array(
			'text' =>	$cat_name,
			'value'	=>	$cat_slug
		);
	}
	//In JQuery value and text for 'woocommerce' and 'wud-latest' must be the same!
	$list1[] = array('text' => 'wud-latest', 'value' => 'wud-latest');
	$list2[] = array('text' => 'woocommerce', 'value' => 'woocommerce');
	$list3[] = array('text' => 'woofeatured', 'value' => 'woofeatured');
	$list4 = array_merge($list, $list1, $list2, $list3);

	$showres = NULL;	
	$showres .= "<form id='grid_wud_cpt_list_tax_array'>";	
	$showres .= "<input type='hidden' name='wud_tax_all' id='wud_tax_all' value='".json_encode($list4)."'/>";
	$showres .= "</form>";
	echo $showres;	
}


// Function for new button
function grid_wud_tinymce_button( $plugin_array ) {
  $plugin_array['grid_wud_mce_button'] =  plugin_dir_url(__FILE__) . "js/grid-wud-buttons.js" ;
  return $plugin_array;
}

// Register new button in the editor
function grid_wud_register_mce_button( $buttons ) {
	$add_array = 0;
	foreach ($buttons as $value) {
		//echo $value."<br>";
    if($value == 'grid_wud_mce_button'){$add_array = 1;}
}
  if($add_array==0){array_push( $buttons, 'grid_wud_mce_button' );}
  return $buttons;
}	
?>