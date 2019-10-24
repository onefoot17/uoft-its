<?php
 /*
=== Grid WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	function grid_wud_options_notice() {
	global $gwfuncs, $_wp_additional_image_sizes;
	
		echo '<div class="grid-wud-admin-table">';
		echo '<h1>PLEASE NOTICE THAT WE STOPPED DEVELOPING GRID-WUD</h1>';
		echo '<img src="' . plugins_url( '../images/logo-grid-wud.png', __FILE__ ) . '">';
		echo '<a id="grid-rate-it" href="https://wordpress.org/support/topic/grid-wud-eol/" target="_blank" title="100% FREE PRO SUPPORT" ><img src="' . plugins_url( '../images/wud-support.png', __FILE__ ) . '"></a>';
		
		//SAVE THE VALUES TO WP_OPTIONS
	if ( isset($_POST['wud_opt_hidden']) && $_POST['wud_opt_hidden'] == 'Y' ) {
			
		// CSS choice $grid_wud_my_css = get_option('grid_wud_my_css');
		$grid_wud_my_css = filter_var($_POST['grid_wud_my_css'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_my_css', $grid_wud_my_css);
			
		if ( isset($_POST['grid_wud_but_bcolor'])) {$grid_wud_but_bcolor = filter_var($_POST['grid_wud_but_bcolor'], FILTER_SANITIZE_STRING);} else{$grid_wud_but_bcolor ="#F73535";}
		update_option('grid_wud_but_bcolor', $grid_wud_but_bcolor);
		
		if ( isset($_POST['grid_wud_but_fcolor'])) {$grid_wud_but_fcolor = filter_var($_POST['grid_wud_but_fcolor'], FILTER_SANITIZE_STRING);} else{$grid_wud_but_fcolor ="#FFFFFF";}
		update_option('grid_wud_but_fcolor', $grid_wud_but_fcolor);	

		if ( isset($_POST['grid_wud_bgc1'])) {$grid_wud_bgc1 = filter_var($_POST['grid_wud_bgc1'], FILTER_SANITIZE_STRING);} else{$grid_wud_bgc1 ="#FFFFFF";}
		update_option('grid_wud_bgc1', $grid_wud_bgc1);
		
		if ( isset($_POST['grid_wud_bgc2'])) {$grid_wud_bgc2 = filter_var($_POST['grid_wud_bgc2'], FILTER_SANITIZE_STRING);} else{$grid_wud_bgc2 ="#FFFFFF";}
		update_option('grid_wud_bgc2', $grid_wud_bgc2);		
		
		if ( isset($_POST['grid_wud_bgc3'])) {$grid_wud_bgc3 = filter_var($_POST['grid_wud_bgc3'], FILTER_SANITIZE_STRING);} else{$grid_wud_bgc3 ="#FFFFFF";}
		update_option('grid_wud_bgc3', $grid_wud_bgc3);
		
		if ( isset($_POST['grid_wud_bgc4'])) {$grid_wud_bgc4 = filter_var($_POST['grid_wud_bgc4'], FILTER_SANITIZE_STRING);} else{$grid_wud_bgc4 ="#FFFFFF";}
		update_option('grid_wud_bgc4', $grid_wud_bgc4);
		
		if ( isset($_POST['grid_wud_bgc5'])) {$grid_wud_bgc5 = filter_var($_POST['grid_wud_bgc5'], FILTER_SANITIZE_STRING);} else{$grid_wud_bgc5 ="#FFFFFF";}
		update_option('grid_wud_bgc5', $grid_wud_bgc5);
		
		$grid_wud_but_font_size = filter_var($_POST['grid_wud_but_font_size'], FILTER_SANITIZE_STRING);
		if($grid_wud_but_font_size==''){$grid_wud_but_font_size='16';}
		update_option('grid_wud_but_font_size', ($grid_wud_but_font_size/10));

		$grid_wud_size_excerpt = filter_var($_POST['grid_wud_size_excerpt'], FILTER_SANITIZE_STRING);
		if($grid_wud_size_excerpt==''){$grid_wud_size_excerpt='16';}
		update_option('grid_wud_size_excerpt', ($grid_wud_size_excerpt));
		
		if ( isset($_POST['grid_wud_cat_bcolor'])) {$grid_wud_cat_bcolor = filter_var($_POST['grid_wud_cat_bcolor'], FILTER_SANITIZE_STRING);} else{$grid_wud_cat_bcolor ="#F73535";}
		update_option('grid_wud_cat_bcolor', $grid_wud_cat_bcolor);
		
		if ( isset($_POST['grid_wud_cat_fcolor'])) {$grid_wud_cat_fcolor = filter_var($_POST['grid_wud_cat_fcolor'], FILTER_SANITIZE_STRING);} else{$grid_wud_cat_fcolor ="#FFFFFF";}
		update_option('grid_wud_cat_fcolor', $grid_wud_cat_fcolor);		

		$grid_wud_h1_font_size = filter_var($_POST['grid_wud_h1_font_size'], FILTER_SANITIZE_STRING);
		if($grid_wud_h1_font_size==''){$grid_wud_h1_font_size='21';}
		update_option('grid_wud_h1_font_size', ($grid_wud_h1_font_size/10));
		
		if ( isset($_POST['grid_wud_hide_cat_tag_header'])) {$grid_wud_hide_cat_tag_header = filter_var($_POST['grid_wud_hide_cat_tag_header'], FILTER_SANITIZE_STRING);} else{$grid_wud_hide_cat_tag_header =0;}
		update_option('grid_wud_hide_cat_tag_header', $grid_wud_hide_cat_tag_header);	
		
		if ( isset($_POST['grid_wud_cat_url'])) {$grid_wud_cat_url = filter_var($_POST['grid_wud_cat_url'], FILTER_SANITIZE_STRING);} else{$grid_wud_cat_url =0;}
		update_option('grid_wud_cat_url', $grid_wud_cat_url);			

		if ( isset($_POST['grid_wud_hide_grid_cat'])) {$grid_wud_hide_grid_cat = filter_var($_POST['grid_wud_hide_grid_cat'], FILTER_SANITIZE_STRING);} else{$grid_wud_hide_grid_cat =0;}
		update_option('grid_wud_hide_grid_cat', $grid_wud_hide_grid_cat);
		
		if ( isset($_POST['grid_wud_set_order_grid'])) {$grid_wud_set_order_grid = filter_var($_POST['grid_wud_set_order_grid'], FILTER_SANITIZE_STRING);} else{$grid_wud_set_order_grid =0;}
		update_option('grid_wud_set_order_grid', $grid_wud_set_order_grid);

		$grid_wud_set_dir_grid = filter_var($_POST['grid_wud_set_dir_grid'], FILTER_SANITIZE_STRING);
		if ( $grid_wud_set_order_grid == "rand" ){$grid_wud_set_dir_grid = "none";}
		update_option('grid_wud_set_dir_grid', $grid_wud_set_dir_grid);	

		if ( isset($_POST['grid_wud_set_featured_img'])) {$grid_wud_set_featured_img = filter_var($_POST['grid_wud_set_featured_img'], FILTER_SANITIZE_STRING);} else{$grid_wud_set_featured_img =0;}
		update_option('grid_wud_set_featured_img', $grid_wud_set_featured_img);	

		if ( isset($_POST['grid_wud_img_hover'])) {$grid_wud_img_hover = filter_var($_POST['grid_wud_img_hover'], FILTER_SANITIZE_STRING);} else{$grid_wud_img_hover =0;}
		update_option('grid_wud_img_hover', $grid_wud_img_hover);	

		if ( isset($_POST['grid_wud_img_grey'])) {$grid_wud_img_grey = filter_var($_POST['grid_wud_img_grey'], FILTER_SANITIZE_STRING);} else{$grid_wud_img_grey =0;}
		update_option('grid_wud_img_grey', $grid_wud_img_grey);	

		if ( isset($_POST['grid_wud_img_split'])) {$grid_wud_img_split = filter_var($_POST['grid_wud_img_split'], FILTER_SANITIZE_STRING);} else{$grid_wud_img_split =0;}
		update_option('grid_wud_img_split', $grid_wud_img_split);			


		if ( isset($_POST['grid_wud_size_split'])) {$grid_wud_size_split = filter_var($_POST['grid_wud_size_split'], FILTER_SANITIZE_STRING);} else{$grid_wud_size_split =0;}
		update_option('grid_wud_size_split', $grid_wud_size_split);


		if ( isset($_POST['grid_wud_rev_back'])) {$grid_wud_rev_back = filter_var($_POST['grid_wud_rev_back'], FILTER_SANITIZE_STRING);} else{$grid_wud_rev_back =0;}
		update_option('grid_wud_rev_back', $grid_wud_rev_back);
		
		if ( isset($_POST['grid_wud_shadow'])) {$grid_wud_shadow = filter_var($_POST['grid_wud_shadow'], FILTER_SANITIZE_STRING);} else{$grid_wud_shadow =0;}
		update_option('grid_wud_shadow', $grid_wud_shadow);	

		if ( isset($_POST['grid_wud_act_gallery'])) {$grid_wud_act_gallery = filter_var($_POST['grid_wud_act_gallery'], FILTER_SANITIZE_STRING);} else{$grid_wud_act_gallery =0;}
		update_option('grid_wud_act_gallery', $grid_wud_act_gallery);

		if ( isset($_POST['grid_wud_url_gallery'])) {$grid_wud_url_gallery = filter_var($_POST['grid_wud_url_gallery'], FILTER_SANITIZE_STRING);} else{$grid_wud_url_gallery =0;}
		update_option('grid_wud_url_gallery', $grid_wud_url_gallery);

		if ( isset($_POST['grid_wud_lb_gallery'])) {$grid_wud_lb_gallery = filter_var($_POST['grid_wud_lb_gallery'], FILTER_SANITIZE_STRING);} else{$grid_wud_lb_gallery =0;}
		update_option('grid_wud_lb_gallery', $grid_wud_lb_gallery);

		if ( isset($_POST['grid_wud_thumb_gallery'])) {$grid_wud_thumb_gallery = filter_var($_POST['grid_wud_thumb_gallery'], FILTER_SANITIZE_STRING);} else{$grid_wud_thumb_gallery =0;}
		update_option('grid_wud_thumb_gallery', $grid_wud_thumb_gallery);

		if ( isset($_POST['grid_wud_thumb_img'])) {$grid_wud_thumb_img = filter_var($_POST['grid_wud_thumb_img'], FILTER_SANITIZE_STRING);} else{$grid_wud_thumb_img =0;}
		update_option('grid_wud_thumb_img', $grid_wud_thumb_img);				
				
		$grid_wud_set_max_grid = filter_var($_POST['grid_wud_set_max_grid'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_set_max_grid', $grid_wud_set_max_grid);

		$grid_wud_set_more_grid = filter_var($_POST['grid_wud_set_more_grid'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_set_more_grid', $grid_wud_set_more_grid);

		$grid_wud_skip_post = filter_var($_POST['grid_wud_skip_post'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_skip_post', $grid_wud_skip_post);

		$grid_wud_show_excerpt = filter_var($_POST['grid_wud_show_excerpt'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_show_excerpt', $grid_wud_show_excerpt);

		$grid_wud_title_pos = filter_var($_POST['grid_wud_title_pos'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_title_pos', $grid_wud_title_pos);

		$grid_wud_title_topmid = filter_var($_POST['grid_wud_title_topmid'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_title_topmid', $grid_wud_title_topmid);

		$grid_wud_show_arch_button = filter_var($_POST['grid_wud_show_arch_button'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_show_arch_button', sanitize_text_field($grid_wud_show_arch_button));

		$grid_wud_show_grid_button = filter_var($_POST['grid_wud_show_grid_button'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_show_grid_button', sanitize_text_field($grid_wud_show_grid_button));

		$grid_wud_show_arch_grid = filter_var($_POST['grid_wud_show_arch_grid'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_show_arch_grid', $grid_wud_show_arch_grid);

		$grid_wud_nourl = filter_var($_POST['grid_wud_nourl'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_nourl', $grid_wud_nourl);

		$grid_wud_popup = filter_var($_POST['grid_wud_popup'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_popup', $grid_wud_popup);
		
		$grid_wud_container_pos = filter_var($_POST['grid_wud_container_pos'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_container_pos', $grid_wud_container_pos);
		
		$grid_wud_excerpt_words = filter_var($_POST['grid_wud_excerpt_words'], FILTER_SANITIZE_STRING);
		if($grid_wud_excerpt_words==''){$grid_wud_excerpt_words=25;}
		update_option('grid_wud_excerpt_words', sanitize_text_field($grid_wud_excerpt_words));

		if ( isset($_POST['grid_wud_fade_in'])) {$grid_wud_fade_in = filter_var($_POST['grid_wud_fade_in'], FILTER_SANITIZE_STRING);} else{$grid_wud_fade_in =0;}
		update_option('grid_wud_fade_in', $grid_wud_fade_in);	

		$grid_wud_cpt01 = filter_var($_POST['grid_wud_cpt01'], FILTER_SANITIZE_STRING);
		if(empty($grid_wud_cpt01)){$grid_wud_cpt01="Custom Post Type 1";}
		update_option('grid_wud_cpt01', sanitize_text_field($grid_wud_cpt01));

		$grid_wud_cpt02 = filter_var($_POST['grid_wud_cpt02'], FILTER_SANITIZE_STRING);
		if(empty($grid_wud_cpt02)){$grid_wud_cpt02="Custom Post Type 2";}
		update_option('grid_wud_cpt02', sanitize_text_field($grid_wud_cpt02));

		$grid_wud_news_title = filter_var($_POST['grid_wud_news_title'], FILTER_SANITIZE_STRING);
		if(empty($grid_wud_news_title)){$grid_wud_news_title="Latest News";}
		update_option('grid_wud_news_title', sanitize_text_field($grid_wud_news_title));
		
		$grid_wud_def_img = filter_var($_POST['grid_wud_def_img'], FILTER_SANITIZE_STRING);
		if(empty($grid_wud_def_img)){$grid_wud_def_img=plugins_url('../images/empty-grid.png', __FILE__ );}
		update_option('grid_wud_def_img', sanitize_text_field($grid_wud_def_img));

		$grid_wud_round_img = filter_var($_POST['grid_wud_round_img'], FILTER_SANITIZE_STRING);
		if($grid_wud_round_img==''){$grid_wud_round_img='0';}
		update_option('grid_wud_round_img', ($grid_wud_round_img));
		
		$grid_wud_round_index = filter_var($_POST['grid_wud_round_index'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_round_index', ($grid_wud_round_index));

		$grid_wud_width = filter_var($_POST['grid_wud_width'], FILTER_SANITIZE_STRING);
		if($grid_wud_width==''){$grid_wud_width='0';}
		update_option('grid_wud_width', ($grid_wud_width));

		$grid_wud_width_px = filter_var($_POST['grid_wud_width_px'], FILTER_SANITIZE_STRING);
		if($grid_wud_width_px==''){$grid_wud_width_px='0';}
		update_option('grid_wud_width_px', ($grid_wud_width_px));
		
		$grid_wud_round_button = filter_var($_POST['grid_wud_round_button'], FILTER_SANITIZE_STRING);
		if($grid_wud_round_button==''){$grid_wud_round_button='0';}
		update_option('grid_wud_round_button', ($grid_wud_round_button));

		$grid_wud_font_header = filter_var($_POST['grid_wud_font_header'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_font_header', $grid_wud_font_header);

		$grid_wud_hide_button = filter_var($_POST['grid_wud_hide_button'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_hide_button', $grid_wud_hide_button);
		
		$grid_wud_font_excerpt = filter_var($_POST['grid_wud_font_excerpt'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_font_excerpt', $grid_wud_font_excerpt);

		$grid_wud_font_button = filter_var($_POST['grid_wud_font_button'], FILTER_SANITIZE_STRING);
		update_option('grid_wud_font_button', $grid_wud_font_button);
		
		//WUD MASTER KEY (set do_shortcode message off)
		$wud_master_key = filter_var($_POST['wud_master_key'], FILTER_SANITIZE_STRING);
		update_option('wud_master_key', filter_var($wud_master_key, FILTER_SANITIZE_STRING));
		
		if( empty($error) ){
		echo '<div class="updated"><p><strong>'.__("Settings saved", "grid-wud").'</strong></p></div>';
		}else{
		echo "<div class='error'><p><strong>";
			foreach ( $error as $key=>$val ) {
				_e($val, 'wud'); 
				echo "<br/>";
			}
		echo "</strong></p></div>";
		    }
	} 
	else {
		
		//If read the first time when opening this page, declare variables
		$grid_wud_my_css = $gwfuncs['grid_wud_my_css'];
		$grid_wud_cat_bcolor = $gwfuncs['grid_wud_cat_bcolor'];
		$grid_wud_cat_fcolor = $gwfuncs['grid_wud_cat_fcolor'];
		$grid_wud_h1_font_size = ($gwfuncs['grid_wud_h1_font_size']*10);
		$grid_wud_set_featured_img = $gwfuncs['grid_wud_set_featured_img'];
		$grid_wud_set_max_grid = $gwfuncs['grid_wud_set_max_grid'];
		$grid_wud_set_more_grid = $gwfuncs['grid_wud_set_more_grid'];
		$grid_wud_hide_cat_tag_header = $gwfuncs['grid_wud_hide_cat_tag_header'];
		$grid_wud_cat_url = $gwfuncs['grid_wud_cat_url'];
		$grid_wud_hide_grid_cat = $gwfuncs['grid_wud_hide_grid_cat'];	
		$grid_wud_show_excerpt = $gwfuncs['grid_wud_show_excerpt'];
		$grid_wud_act_gallery = $gwfuncs['grid_wud_act_gallery'];
		$grid_wud_url_gallery = $gwfuncs['grid_wud_url_gallery'];
		$grid_wud_lb_gallery = $gwfuncs['grid_wud_lb_gallery'];
		$grid_wud_thumb_gallery = $gwfuncs['grid_wud_thumb_gallery'];
		$grid_wud_thumb_img = $gwfuncs['grid_wud_thumb_img'];
		$grid_wud_show_arch_button = $gwfuncs['grid_wud_show_arch_button'];
		$grid_wud_show_grid_button = $gwfuncs['grid_wud_show_grid_button'];
		$grid_wud_show_arch_grid = $gwfuncs['grid_wud_show_arch_grid'];
		$grid_wud_set_order_grid = $gwfuncs['grid_wud_set_order_grid'];
		$grid_wud_set_dir_grid = $gwfuncs['grid_wud_set_dir_grid'];
		$grid_wud_but_bcolor = $gwfuncs['grid_wud_but_bcolor'];
		$grid_wud_but_fcolor = $gwfuncs['grid_wud_but_fcolor'];
		$grid_wud_but_font_size = ($gwfuncs['grid_wud_but_font_size']*10);
		$grid_wud_size_excerpt = ($gwfuncs['grid_wud_size_excerpt']);
		$grid_wud_excerpt_words = $gwfuncs['grid_wud_excerpt_words'];
		$grid_wud_skip_post = $gwfuncs['grid_wud_skip_post'];
		$grid_wud_fade_in = $gwfuncs['grid_wud_fade_in'];
		$grid_wud_cpt01 = $gwfuncs['grid_wud_cpt01'];
		$grid_wud_cpt02 = $gwfuncs['grid_wud_cpt02'];
		$grid_wud_def_img = $gwfuncs['grid_wud_def_img'];
		$grid_wud_img_hover = $gwfuncs['grid_wud_img_hover'];
		$grid_wud_img_grey = $gwfuncs['grid_wud_img_grey'];
		$grid_wud_img_split = $gwfuncs['grid_wud_img_split'];
		$grid_wud_size_split = $gwfuncs['grid_wud_size_split'];
		$grid_wud_rev_back = $gwfuncs['grid_wud_rev_back'];
		$grid_wud_round_img = $gwfuncs['grid_wud_round_img'];
		$grid_wud_round_index = $gwfuncs['grid_wud_round_index'];
		$grid_wud_round_button = $gwfuncs['grid_wud_round_button'];
		$grid_wud_font_header = $gwfuncs['grid_wud_font_header'];
		$grid_wud_hide_button = $gwfuncs['grid_wud_hide_button'];
		$grid_wud_font_excerpt = $gwfuncs['grid_wud_font_excerpt'];
		$grid_wud_font_button = $gwfuncs['grid_wud_font_button'];
		$grid_wud_title_pos = $gwfuncs['grid_wud_title_pos'];
		$grid_wud_title_topmid = $gwfuncs['grid_wud_title_topmid'];
		$grid_wud_news_title = $gwfuncs['grid_wud_news_title'];
		$grid_wud_nourl = $gwfuncs['grid_wud_nourl'];
		$grid_wud_popup = $gwfuncs['grid_wud_popup'];
		$grid_wud_container_pos = $gwfuncs['grid_wud_container_pos'];
		$grid_wud_shadow = $gwfuncs['grid_wud_shadow'];
		$grid_wud_width = $gwfuncs['grid_wud_width'];
		$grid_wud_width_px = $gwfuncs['grid_wud_width_px'];
		$grid_wud_bgc1 = $gwfuncs['grid_wud_bgc1'];
		$grid_wud_bgc2 = $gwfuncs['grid_wud_bgc2'];
		$grid_wud_bgc3 = $gwfuncs['grid_wud_bgc3'];
		$grid_wud_bgc4 = $gwfuncs['grid_wud_bgc4'];
		$grid_wud_bgc5 = $gwfuncs['grid_wud_bgc5'];
		$wud_master_key = $gwfuncs['wud_master_key'];
	}

//LEFT ADMIN 
// echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("tips, help, support and others2", "grid-wud").'</div></div>';

		//Form start
	    echo "<form name='grid_wud_form' method='post' action=".admin_url('admin.php')."?page=grid-wud>";
		
		echo "<div class='grid-wud-wrap'>";
		
		echo "<input type='hidden' name='wud_opt_hidden' value='Y'>";
		
		echo '<b class="grid-wud-admin-title">'.__("Category or Tag Title", "grid-wud").'</b>';
		echo '<label class="cs-wp-color" >'.__("Background", "grid-wud").': </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_cat_bcolor" value="'. $grid_wud_cat_bcolor. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("Text", "grid-wud").': </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_cat_fcolor" value="'. $grid_wud_cat_fcolor. '" data-rgba="false"><br><br>';

		echo '<dl><dt><label for="wud_box1">'.__("Font size", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box1" type="text" style="font-weight:bolder;" value="'.$grid_wud_h1_font_size.'" readonly/></dd>
		<dt><label for="wud_sizer1"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer1" type="range" min="12" max="34" step="1" value="'.$grid_wud_h1_font_size.'" name="grid_wud_h1_font_size" onchange="wud_box1.value = wud_sizer1.value" oninput="wud_box1.value = wud_sizer1.value" /></dd></dl><br>';
	
		echo '<select name="grid_wud_font_header" class="grid-wud-right" >';
		echo     '<option value="inherit"'; if ( $grid_wud_font_header == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
		echo     '<option value="initial"'; if ( $grid_wud_font_header == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
		echo     '<option value="Arial"'; if ( $grid_wud_font_header == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
		echo     '<option value="Times New Roman"'; if ( $grid_wud_font_header == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
		echo     '<option value="Georgia"'; if ( $grid_wud_font_header == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
		echo     '<option value="Serif"'; if ( $grid_wud_font_header == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
		echo     '<option value="Helvetica"'; if ( $grid_wud_font_header == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
		echo     '<option value="Lucida Sans Unicode"'; if ( $grid_wud_font_header == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
		echo     '<option value="Tahoma"'; if ( $grid_wud_font_header == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
		echo     '<option value="Verdana"'; if ( $grid_wud_font_header == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
		echo     '<option value="Courier New"'; if ( $grid_wud_font_header == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
		echo     '<option value="Lucida Console"'; if ( $grid_wud_font_header == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
		echo '</select>';		
		echo '<label class="grid-wud-admin-title">'.__("Font Family", "grid-wud").'</label><br><br>';
		
		echo '<label>'.__("Hide", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_hide_cat_tag_header" type="checkbox" value="1" '. checked( $grid_wud_hide_cat_tag_header, "1", false ) .'/><br><br>';
		
		echo '<label>'.__("Enable URL on title", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_cat_url" type="checkbox" value="1" '. checked( $grid_wud_cat_url, "1", false ) .'/><br><hr>';

		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If selected the Category/Tag is visible in the right top grid corner.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Show Category/Tag on the grid", "grid-wud").'</b><br>';
		echo '<label>'.__("Show", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_hide_grid_cat" type="checkbox" value="1" '. checked( $grid_wud_hide_grid_cat, "1", false ) .'/><br><br>';
	
		echo '<b class="grid-wud-admin-title">'.__("Featured image", "grid-wud").'</b>';
		echo '<label>'.__("Set as primary to display", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_set_featured_img" type="checkbox" value="1" '. checked( $grid_wud_set_featured_img, "1", false ) .'/><br><hr>';
			
		echo '<b class="grid-wud-admin-title">'.__("Image on hover", "grid-wud").'</b>';
		echo '<label>'.__("Zoom the grid image on hover", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_img_hover" type="checkbox" value="1" '. checked( $grid_wud_img_hover, "1", false ) .'/><br><br>';
			
		echo '<b class="grid-wud-admin-title">'.__("Grey images", "grid-wud").'</b>';
		echo '<label>'.__("Show the grid in grey and on hover in colors", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_img_grey" type="checkbox" value="1" '. checked( $grid_wud_img_grey, "1", false ) .'/><br><br>';

		echo '<dl><dt><label for="wud_box7">'.__("Round corners", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box7" type="text" style="font-weight:bolder;" value="'.$grid_wud_round_img.'" readonly/></dd>
		<dt><label for="wud_sizer7"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer7" type="range" min="0" max="20" step="1" value="'.$grid_wud_round_img.'" name="grid_wud_round_img" onchange="wud_box7.value = wud_sizer7.value" oninput="wud_box7.value = wud_sizer7.value" /></dd></dl><hr>';

		echo ''.__("Change only by CSS layer problems (standard=1)", "grid-wud").'<br><dl><dt><label for="wud_box7a">'.__("Z-index value", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box7a" type="text" style="font-weight:bolder;" value="'.$grid_wud_round_index.'" readonly/></dd>
		<dt><label for="wud_sizer7a"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer7a" type="range" min="0" max="98" step="1" value="'.$grid_wud_round_index.'" name="grid_wud_round_index" onchange="wud_box7a.value = wud_sizer7a.value" oninput="wud_box7a.value = wud_sizer7a.value" /></dd></dl><hr>';
		

		echo '<b class="grid-wud-admin-title">'.__("Grids or Tiles", "grid-wud").'</b>';
		echo '<label>'.__("If selected it shows Tiles.", "grid-wud").': </label><input class="grid-wud-right" id="grid_wud_img_split" name="grid_wud_img_split" type="checkbox" value="1" '. checked( $grid_wud_img_split, "1", false ) .'/><br><br>';

		echo '<label>'.__("Tiles shadow.", "grid-wud").': </label><input id="tilesshadow" class="grid-wud-right" name="grid_wud_shadow" type="checkbox" value="1" '. checked( $grid_wud_shadow, "1", false ) .'/><br><br>';
		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If no image was found, use this pre-defined image.<br>You can select any image from the media library, or use the default one.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Default grid image", "grid-wud").'</b><br>';
		echo '<img src="'.$grid_wud_def_img.'" id="image-src" width="150px" height="150px" style="box-shadow: 4px 5px 5px #888888;"/><br>';
		echo '<input id="grid_img" type="hidden" name="grid_img" value="'.plugins_url('../images/empty-grid.png', __FILE__ ).'" />';
		echo '<input id="image-url" type="hidden" name="grid_wud_def_img" value="'.$grid_wud_def_img.'" /><br>';
		echo '<input id="upload-button" type="button" class="button" value="'.__("Upload Image", "grid-wud").'" />  <input id="clear-button" type="button"  class="button" value="'.__("Use the Default Image", "grid-wud").'" " ><br><br>';

		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("The grids/tiles/... will use the selected image size.<br>If the selected size is not found, it will use the Wordpress default size.", "grid-wud").'</div></div>';      
	   $thumbs = get_image_sizes();  	   
		echo '<select name="grid_wud_thumb_img" class="grid-wud-right" >';
		foreach($thumbs as $key => $val) {
		 echo     '<option value="' . $val['id'] . '"'; if ( $grid_wud_thumb_img == $val['id'] ){echo 'selected="selected"';} echo '>'.$val['id']." => ".$key.' ('.$val['size'].')</option>';
		} 
		echo '</select>'; 			
		echo '<label class="grid-wud-admin-title">'.__("Use this image size.", "grid-wud").'</label>';
		echo '<br><hr>';
		

		echo '<label><b>'.__("A container is a collection of grids/tiles", "grid-wud").'</b></label><br>';
		echo __("Tip: use left/right arrow button after you used the slider", "grid-wud")."<br><br>";
		echo '<label><b>'.__("Container maximum size in % or px", "grid-wud").'</b></label><input class="grid-wud-right" id="grid_wud_size_split" name="grid_wud_size_split" type="checkbox" value="1" '. checked( $grid_wud_size_split, "1", false ) .'/><br>';
		
		echo '<dl id="wud_sizer9hs">
		<dd><input size="2" id="wud_box9" type="text" style="font-weight:bolder;" value="'.$grid_wud_width.'" readonly/></dd>
		<dd><input class="grid-wud-right" id="wud_sizer9" type="range" min="50" max="100" step="1" value="'.$grid_wud_width.'" name="grid_wud_width" onchange="wud_box9.value = wud_sizer9.value" oninput="wud_box9.value = wud_sizer9.value" /><b>%</b></dd></dl><br>';

		echo '<dl id="wud_sizer11hs">
		<dd><input size="2" id="wud_box11" type="text" style="font-weight:bolder;" value="'.$grid_wud_width_px.'" readonly/></dd>
		<dd><input class="grid-wud-right" id="wud_sizer11" type="range" min="500" max="1200" step="1" value="'.$grid_wud_width_px.'" name="grid_wud_width_px" onchange="wud_box11.value = wud_sizer11.value" oninput="wud_box11.value = wud_sizer11.value" /><b>px</b></dd></dl>';

		echo '<b>'.__("Container position", "grid-wud").'</b>';
		echo '<select name="grid_wud_container_pos" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_container_pos == "0" ){echo 'selected="selected"';} echo '>'.__("Center", "grid-wud").'</option>';
		echo     '<option value="2"'; if ( $grid_wud_container_pos == "2" ){echo 'selected="selected"';} echo '>'.__("Left", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_container_pos == "1" ){echo 'selected="selected"';} echo '>'.__("Right", "grid-wud").'</option>';
		echo '</select>';
	
		echo '<br><br><br>';		
		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Fade in the pictures of the tiles/grids inside the container , by a post/page load.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Fade in container", "grid-wud").'</b><br>';
		echo '<label>'.__("Active", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_fade_in" type="checkbox" value="1" '. checked( $grid_wud_fade_in, "1", false ) .'/><br><hr>';

		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If Custom Post Type (short code: cp=\"1\") is used it change the title 1 into this text.<br><br>If Pods (short code: pods=\"1\") is used it change the title 1 into this text, if no category or tag title is found.<br><br>The short code [title=\"xx\"] overwrites this title.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Custom Title", "grid-wud").' 1</b><br>';		
		echo '<label>'.__("Text", "grid-wud").' : </label><input type="text" class="grid-wud-right" name="grid_wud_cpt01" value="'.$grid_wud_cpt01.'" /><br><br><br>';
		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If Custom Post Type (short code: cp=\"2\") is used it change the title 2 into this text.<br><br>If Pods (short code: pods=\"2\") is used it change the title 2 into this text, if no category or tag title is found.<br><br>The short code [title=\"xx\"] overwrites this title.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Custom Title", "grid-wud").' 2</b><br>';
		echo '<label>'.__("Text", "grid-wud").' : </label><input type="text" class="grid-wud-right" name="grid_wud_cpt02" value="'.$grid_wud_cpt02.'" /><br><br><br>';

		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If Latest Post slug (short code: slug=\"wud-latest\") is used it change the latest post title into this text.<br><br>The short code [title=\"xx\"] overwrites this title.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Latest Posts Title", "grid-wud").'</b><br>';
		echo '<label>'.__("Text", "grid-wud").' : </label><input type="text" class="grid-wud-right" name="grid_wud_news_title" value="'.$grid_wud_news_title.'" /><br><br><hr>';
		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Depending the order of grid, skip X posts/pages.<br>Sample: order by: date, direction: descending = skip X newest posts/pages. ", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Skip x posts", "grid-wud").'</b><br>
		<label for="wud_box6">'.__("Quantity post to skip", "grid-wud").'</label>&nbsp;&nbsp;<br>
		<dl><dd><input size="2" id="wud_box6" type="text" style="font-weight:bolder;" value="'.$grid_wud_skip_post.'" readonly/></dd>
		<dt><label for="wud_sizer6"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer6" type="range" min="0" max="20" step="1" value="'.$grid_wud_skip_post.'" name="grid_wud_skip_post" onchange="wud_box6.value = wud_sizer6.value" oninput="wud_box6.value = wud_sizer6.value" /></dd></dl><hr>';
		
		echo '</div>';
//RIGHT ADMIN		
		echo "<div class='grid-wud-wrap-2'>";

		echo '<b class="grid-wud-admin-title">'.__("Buttons", "grid-wud").'</b>';
		echo '<label class="cs-wp-color" >'.__("Background", "grid-wud").': </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_but_bcolor" value="'. $grid_wud_but_bcolor. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("Text", "grid-wud").': </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_but_fcolor" value="'. $grid_wud_but_fcolor. '" data-rgba="false"><br><br>';

		echo '<dl><dt><label for="wud_box3">'.__("Font size", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box3" type="text" style="font-weight:bolder;" value="'.$grid_wud_but_font_size.'" readonly/></dd>
		<dt><label for="wud_sizer3"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer3" type="range" min="10" max="30" step="1" value="'.$grid_wud_but_font_size.'" name="grid_wud_but_font_size" onchange="wud_box3.value = wud_sizer3.value" oninput="wud_box3.value = wud_sizer3.value" /></dd></dl><br>';
	
		echo '<select name="grid_wud_font_button" class="grid-wud-right" >';
		echo     '<option value="inherit"'; if ( $grid_wud_font_button == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
		echo     '<option value="initial"'; if ( $grid_wud_font_button == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
		echo     '<option value="Arial"'; if ( $grid_wud_font_button == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
		echo     '<option value="Times New Roman"'; if ( $grid_wud_font_button == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
		echo     '<option value="Georgia"'; if ( $grid_wud_font_button == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
		echo     '<option value="Serif"'; if ( $grid_wud_font_button == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
		echo     '<option value="Helvetica"'; if ( $grid_wud_font_button == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
		echo     '<option value="Lucida Sans Unicode"'; if ( $grid_wud_font_button == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
		echo     '<option value="Tahoma"'; if ( $grid_wud_font_button == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
		echo     '<option value="Verdana"'; if ( $grid_wud_font_button == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
		echo     '<option value="Courier New"'; if ( $grid_wud_font_button == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
		echo     '<option value="Lucida Console"'; if ( $grid_wud_font_button == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
		echo '</select>';		
		echo '<label class="grid-wud-admin-title">'.__("Font Family", "grid-wud").'</label>';	
		echo '<br><br>';
						
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Text for the read more button on archive, category, tags pages.<br>If empty we show a [+] sign, otherwise the text you entered here. ", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Archive: read more button or text", "grid-wud").'</b><br>';
		echo '<label>'.__("Empty = button", "grid-wud").' </label><b>[+]</b>  : <input type="text" class="grid-wud-right" name="grid_wud_show_arch_button" value="'.$grid_wud_show_arch_button.'" /><br><br><br>';

		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Text for the read more button on pages containing our short code.<br>If empty we show a [+] sign, otherwise the text you entered here. ", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("grid: read more button or text", "grid-wud").'</b><br>';
		echo '<label>'.__("Empty = button", "grid-wud").' </label><b>[+]</b> : <input type="text" class="grid-wud-right" name="grid_wud_show_grid_button" value="'.$grid_wud_show_grid_button.'" /><br><br><br>';

		echo '<dl><dt><label for="wud_box8">'.__("Round corners", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box8" type="text" style="font-weight:bolder;" value="'.$grid_wud_round_button.'" readonly/></dd>
		<dt><label for="wud_sizer8"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer8" type="range" min="0" max="20" step="1" value="'.$grid_wud_round_button.'" name="grid_wud_round_button" onchange="wud_box8.value = wud_sizer8.value" oninput="wud_box8.value = wud_sizer8.value" /></dd></dl><br>';

		echo '<select name="grid_wud_hide_button" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_hide_button == "0" ){echo 'selected="selected"';} echo '>Do Nothing</option>';
		echo     '<option value="1"'; if ( $grid_wud_hide_button == "1" ){echo 'selected="selected"';} echo '>Hide</option>';
		echo     '<option value="2"'; if ( $grid_wud_hide_button == "2" ){echo 'selected="selected"';} echo '>Gray Overlay</option>';
		echo '</select>';		
		echo '<label class="grid-wud-admin-title">'.__("When last Grid is displayed", "grid-wud").'</label><br><hr>';
		
		echo '<select name="grid_wud_my_css" class="grid-wud-right" >';
		echo     '<option value="grid-wud"'; if ( $grid_wud_my_css == "grid-wud" ){echo 'selected="selected"';} echo '>1 Standard</option>';
		echo     '<option value="grid-wud-square"'; if ( $grid_wud_my_css == "grid-wud-square" ){echo 'selected="selected"';} echo '>2 Square</option>';
		echo     '<option value="grid-wud-blocks"'; if ( $grid_wud_my_css == "grid-wud-blocks" ){echo 'selected="selected"';} echo '>3 Blocks</option>';
		echo     '<option value="grid-wud-circle"'; if ( $grid_wud_my_css == "grid-wud-circle" ){echo 'selected="selected"';} echo '>4 Circle</option>';
		echo     '<option value="grid-wud-photos"'; if ( $grid_wud_my_css == "grid-wud-photos" ){echo 'selected="selected"';} echo '>5 Photo\'s</option>';
		echo     '<option value="grid-wud-horizon"'; if ( $grid_wud_my_css == "grid-wud-horizon" ){echo 'selected="selected"';} echo '>6 Horizon</option>';
		echo     '<option value="grid-wud-mixed"'; if ( $grid_wud_my_css == "grid-wud-mixed" ){echo 'selected="selected"';} echo '>7 Mixed One</option>';
		echo     '<option value="grid-wud-mixed2"'; if ( $grid_wud_my_css == "grid-wud-mixed2" ){echo 'selected="selected"';} echo '>8 Mixed Two</option>';
		echo '</select>';		
		echo '<b class="grid-wud-admin-title">'.__("Lay-out grids/tiles/tables", "grid-wud").'</b>';
		echo '<label>'.__("Choose lay-out", "grid-wud").': </label>';		
		echo '<br><br>';


		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Enter the number of grid to be displayed , for each entered short code.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Number of grid to show", "grid-wud").'</b>
		<dl><dt><label for="wud_box4">'.__("Maximum", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box4" type="text" style="font-weight:bolder;" value="'.$grid_wud_set_max_grid.'" readonly/></dd>
		<dt><label for="wud_sizer4"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer4" type="range" min="4" max="20" step="1" value="'.$grid_wud_set_max_grid.'" name="grid_wud_set_max_grid" onchange="wud_box4.value = wud_sizer4.value" oninput="wud_box4.value = wud_sizer4.value" /></dd></dl><br>';


		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Enter the number of extra grid to be displayed , after clicking on the read more button.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Show more grid button", "grid-wud").'</b>
		<label for="wud_box5">'.__("Number of extra grid to show", "grid-wud").'</label>&nbsp;&nbsp;<br>
		<dl><dd><input size="2" id="wud_box5" type="text" style="font-weight:bolder;" value="'.$grid_wud_set_more_grid.'" readonly/></dd>
		<dt><label for="wud_sizer5"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer5" type="range" min="2" max="10" step="2" value="'.$grid_wud_set_more_grid.'" name="grid_wud_set_more_grid" onchange="wud_box5.value = wud_sizer5.value" oninput="wud_box5.value = wud_sizer5.value" /></dd></dl><hr>';

			
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If selected: Show the read more result as archive pages (standard) or as grid.", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Target: read more button", "grid-wud").'</b><br>';
		echo '<select name="grid_wud_show_arch_grid" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_show_arch_grid == "0" ){echo 'selected="selected"';} echo '>'.__("Grids", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_show_arch_grid == "1" ){echo 'selected="selected"';} echo '>'.__("Archive", "grid-wud").'</option>';
		echo '</select>';		
		echo '<label>'.__("Archive or grid", "grid-wud").': </label>';	
		echo '<br><br><br>';
		
		echo '<select name="grid_wud_set_order_grid" class="grid-wud-right" >';
		echo     '<option value="date"'; if ( $grid_wud_set_order_grid == "date" ){echo 'selected="selected"';} echo '>'.__("1 - Date", "grid-wud").'</option>';
		echo     '<option value="name"'; if ( $grid_wud_set_order_grid == "name" ){echo 'selected="selected"';} echo '>'.__("2 - Name", "grid-wud").'</option>';
		echo     '<option value="ID"'; if ( $grid_wud_set_order_grid == "ID" ){echo 'selected="selected"';} echo '>'.__("3 - Post ID", "grid-wud").'</option>';
		echo     '<option value="rand"'; if ( $grid_wud_set_order_grid == "rand" ){echo 'selected="selected"';} echo '>'.__("9 - Random", "grid-wud").'</option>';
		echo '</select>';		
		echo '<b class="grid-wud-admin-title">'.__("Order by", "grid-wud").'</b>';
		echo '<label>'.__("Order grid by", "grid-wud").': </label>';		
		echo '<br><br>';
		
		echo '<select id="not_99" name="grid_wud_set_dir_grid" class="grid-wud-right" >';
		echo     '<option value="ASC"'; if ( $grid_wud_set_dir_grid == "ASC" ){echo 'selected="selected"';} echo '>'.__("1 - Ascending", "grid-wud").'</option>';
		echo     '<option value="DESC"'; if ( $grid_wud_set_dir_grid == "DESC" ){echo 'selected="selected"';} echo '>'.__("2 - Descending", "grid-wud").'</option>';
		echo     '<option value="none"'; if ( $grid_wud_set_dir_grid == "none" ){echo 'selected="selected"';} echo '>'.__("9 - None", "grid-wud").'</option>';
		echo '</select>';
		
		echo '<b class="grid-wud-admin-title">'.__("Order direction", "grid-wud").'</b>';
		echo '<label>'.__("Sort order grid", "grid-wud").': </label>';		
		echo '<br>';
		echo '<label>'.__("To force another order use shortcode: ", "grid-wud").'[order="xx"]</label><br>';
		echo '<label>'.__("Sample order by name & Ascending : ", "grid-wud").'[order="21"]</label><br>';
		echo '<label>'.__("Force a random grids /tiles order : ", "grid-wud").'[order="99"]</label><hr>';
		
		echo '<b class="grid-wud-admin-title">'.__("Target/Structure URL grids", "grid-wud").'</b><br>';
		echo '<select name="grid_wud_popup" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_popup == "0" ){echo 'selected="selected"';} echo '>'.__("Post or Page", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_popup == "1" ){echo 'selected="selected"';} echo '>'.__("LightBox Popup", "grid-wud").'</option>';
		echo '</select>';
		echo '<label>'.__("Post/Page or Popup", "grid-wud").': </label>';
		echo '<br><br>';
		echo '<select name="grid_wud_nourl" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_nourl == "0" ){echo 'selected="selected"';} echo '>'.__("URL by ID", "grid-wud").'</option>';
		echo     '<option value="2"'; if ( $grid_wud_nourl == "2" ){echo 'selected="selected"';} echo '>'.__("URL by Name", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_nourl == "1" ){echo 'selected="selected"';} echo '>'.__("None", "grid-wud").'</option>';
		echo '</select>';
		echo '<label>'.__("URL Structure", "grid-wud").': </label>';	
		echo '<br><br><hr>';
		
		echo '<select name="grid_wud_show_excerpt" class="grid-wud-right" >';
		echo     '<option value="0"'; if ( $grid_wud_show_excerpt == "0" ){echo 'selected="selected"';} echo '>'.__("Show not", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_show_excerpt == "1" ){echo 'selected="selected"';} echo '>'.__("Without title", "grid-wud").'</option>';
		echo     '<option value="2"'; if ( $grid_wud_show_excerpt == "2" ){echo 'selected="selected"';} echo '>'.__("With title", "grid-wud").'</option>';
		echo     '<option value="3"'; if ( $grid_wud_show_excerpt == "3" ){echo 'selected="selected"';} echo '>'.__("Show always", "grid-wud").'</option>';
		echo     '<option id="textonly" value="4"'; if ( $grid_wud_show_excerpt == "4" ){echo 'selected="selected"';} echo '>'.__("Title Only", "grid-wud").'</option>';
		echo '</select>';		
		echo '<b class="grid-wud-admin-title">'.__("The excerpt", "grid-wud").'</b>';
		echo '<label>'.__("Show/Hide ...", "grid-wud").': </label>';	
		echo '<br><br>';
		
		echo '<select name="grid_wud_title_pos" class="grid-wud-right" id="txtonly">';
		echo     '<option value="0"'; if ( $grid_wud_title_pos == "0" ){echo 'selected="selected"';} echo '>'.__("Left", "grid-wud").'</option>';
		echo     '<option value="1"'; if ( $grid_wud_title_pos == "1" ){echo 'selected="selected"';} echo '>'.__("Center", "grid-wud").'</option>';
		echo     '<option value="2"'; if ( $grid_wud_title_pos == "2" ){echo 'selected="selected"';} echo '>'.__("Right", "grid-wud").'</option>';
		echo '</select>';						
		echo '<br><br>';

		echo '<select name="grid_wud_title_topmid" class="grid-wud-right" id="topbot">';
		echo     '<option value="1"'; if ( $grid_wud_title_topmid == "1" ){echo 'selected="selected"';} echo '>'.__("Top", "grid-wud").'</option>';
		echo     '<option value="2"'; if ( $grid_wud_title_topmid == "2" ){echo 'selected="selected"';} echo '>'.__("Middle", "grid-wud").'</option>';
		echo     '<option value="0"'; if ( $grid_wud_title_topmid == "0" ){echo 'selected="selected"';} echo '>'.__("Bottom", "grid-wud").'</option>';		
		echo     '<option value="3"'; if ( $grid_wud_title_topmid == "3" ){echo 'selected="selected"';} echo '>'.__("Spread", "grid-wud").'</option>';
		echo '</select>';						
		echo '<br><br>';
		
		echo '<label><b>'.__("Black background color", "grid-wud").'</b></label><input class="grid-wud-right" id="grid_wud_rev_back" name="grid_wud_rev_back" type="checkbox" value="1" '. checked( $grid_wud_rev_back, "1", false ) .'/><br><br>';
		
		echo '<label>'.__("Maximum words", "grid-wud").' (10 -> 100) : </label><input type="number" min="10" step="1" max="100" size="8" class="grid-wud-right" name="grid_wud_excerpt_words" value="'.$grid_wud_excerpt_words.'" /><br><br>';

				echo '<select name="grid_wud_font_excerpt" class="grid-wud-right" >';
		echo     '<option value="inherit"'; if ( $grid_wud_font_excerpt == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
		echo     '<option value="initial"'; if ( $grid_wud_font_excerpt == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
		echo     '<option value="Arial"'; if ( $grid_wud_font_excerpt == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
		echo     '<option value="Times New Roman"'; if ( $grid_wud_font_excerpt == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
		echo     '<option value="Georgia"'; if ( $grid_wud_font_excerpt == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
		echo     '<option value="Serif"'; if ( $grid_wud_font_excerpt == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
		echo     '<option value="Helvetica"'; if ( $grid_wud_font_excerpt == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
		echo     '<option value="Lucida Sans Unicode"'; if ( $grid_wud_font_excerpt == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
		echo     '<option value="Tahoma"'; if ( $grid_wud_font_excerpt == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
		echo     '<option value="Verdana"'; if ( $grid_wud_font_excerpt == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
		echo     '<option value="Courier New"'; if ( $grid_wud_font_excerpt == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
		echo     '<option value="Lucida Console"'; if ( $grid_wud_font_excerpt == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
		echo '</select>';		
		echo '<label class="grid-wud-admin-title">'.__("Font Family", "grid-wud").'</label>';	
		echo '<br>';

		echo '<dl><dt><label for="wud_box10">'.__("Font size", "grid-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box10" type="text" style="font-weight:bolder;" value="'.$grid_wud_size_excerpt.'" readonly/></dd>
		<dt><label for="wud_sizer10"></label></dt>
		<dd><input class="grid-wud-right" id="wud_sizer10" type="range" min="8" max="20" step="1" value="'.$grid_wud_size_excerpt.'" name="grid_wud_size_excerpt" onchange="wud_box10.value = wud_sizer10.value" oninput="wud_box10.value = wud_sizer10.value" /></dd></dl>';
		
		echo '<b class="grid-wud-admin-title">'.__("Excerpt background color (removes the image).", "grid-wud").'</b>';
		echo '<label class="grid-wud-admin-title">'.__("[bg=\"x\"] = with title, [bg=\"1x\"] = without title.", "grid-wud").'</label><br>';	
		echo '<label class="cs-wp-color" >'.__("", "grid-wud").'[bg="1"] or [bg="11"] </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_bgc1" value="'. $grid_wud_bgc1. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("", "grid-wud").'[bg="2"] or [bg="12"] </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_bgc2" value="'. $grid_wud_bgc2. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("", "grid-wud").'[bg="3"] or [bg="13"] </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_bgc3" value="'. $grid_wud_bgc3. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("", "grid-wud").'[bg="4"] or [bg="14"] </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_bgc4" value="'. $grid_wud_bgc4. '" data-rgba="false"><br><br>';
		echo '<label class="cs-wp-color" >'.__("", "grid-wud").'[bg="5"] or [bg="15"] </label><input type="hidden" class="cs-wp-color-picker" name="grid_wud_bgc5" value="'. $grid_wud_bgc5. '" data-rgba="false"><br><br>';		

	//WUD MASTER KEY (set do_shortcode message off)		
	if(get_option('wud_master_key') != 1){
		if(!function_exists('shortcode_widget_wud_settings_page')){
			echo '<div style="width:100%; background-color:#00e2ff; padding:4px; border: 1px solid #ccc; border-bottom: 2px solid #bbb; border-top: 1px solid #ddd; border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;">';
			$wud_master_key=get_option('wud_master_key');
			echo '<b>To activate any shortcode in widgets use our plugin</b>';
			echo '<br><br><a href="'.admin_url('plugin-install.php').'?s=Shortcode+Widget+WUD&tab=search&type=term" class="button-primary" id="ctp-adm-wud" target="_blank">Shortcode Widget WUD</a> ';
			echo '<br><br><label style="color:blue;">Shortcodes are displayed correctly in widgets,<br>please hide this message.</label><input style="float:right;" name="wud_master_key" type="checkbox" value="1" '. checked( $wud_master_key, "1", false ) .'/>';
			echo '</div>';
		}
	}
	else{
		echo '<input style="float:right;" name="wud_master_key" type="hidden" value="1" '. checked( $wud_master_key, "1", false ) .'/>';
	}
		echo '<br><hr>';
		
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Change the Wordpress Gallery to Grids or Tiles (Wordpress default is off).", "grid-wud").'</div></div>';
		echo '<b class="grid-wud-admin-title">'.__("Grid WUD Gallery", "grid-wud").'</b><br>';		
		echo '<label>'.__("Active", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_act_gallery" type="checkbox" value="1" '. checked( $grid_wud_act_gallery, "1", false ) .'/><br><br>';
		echo '<b class="grid-wud-admin-title">'.__("Enable URL's", "grid-wud").'</b><br>';		
		echo '<label>'.__("Active", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_url_gallery" type="checkbox" value="1" '. checked( $grid_wud_url_gallery, "1", false ) .'/><br><br>';
		echo '<b class="grid-wud-admin-title">'.__("Enable Light Box", "grid-wud").'</b><br>';		
		echo '<label>'.__("Active", "grid-wud").': </label><input class="grid-wud-right" name="grid_wud_lb_gallery" type="checkbox" value="1" '. checked( $grid_wud_lb_gallery, "1", false ) .'/><br><br>';
		echo'<div id="grid-wud-tip"><b class="grid-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("The gallery will use the selected image size.<br>If the selected size is not found, it will use the Wordpress default size.", "grid-wud").'</div></div>';

		$thumbs = get_image_sizes();  		
		echo '<select name="grid_wud_thumb_gallery" class="grid-wud-right" >';
		foreach($thumbs as $key => $val) {
		 echo     '<option value="' . $val['id'] . '"'; if ( $grid_wud_thumb_gallery == $val['id'] ){echo 'selected="selected"';} echo '>'.$val['id']." => ".$key.' ('.$val['size'].')</option>';
		} 
		echo '</select>'; 		
		echo '<label class="grid-wud-admin-title">'.__("Use this image size.", "grid-wud").'</label>';
		
		
		echo '</div><div class="clear"></div>';
		echo '<div><br>';		
		echo '<input type="submit" name="Submit" class="button-primary" id="grid-wud-adm-subm" value="'.__("Save Changes", "grid-wud").'" /><br><br>';
		//Form send
		echo "</form>";
		echo '<h1>PLEASE NOTICE THAT WE STOPPED DEVELOPING GRID-WUD</h1>';
		echo '</div></div>';		
}
?>