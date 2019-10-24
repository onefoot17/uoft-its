<?php
 /*
=== Grid WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	function wud_grid_banners($posts, $bannerheight) {
	$todisplay = NULL;	
	global $gwfuncs, $count_banner, $wud_cat_or_term_name, $wud_cat_or_term_url;
	$count_banner= substr(round(microtime(true) * 1000),10,3);
	$lineheight=$gwfuncs['grid_wud_h1_font_size']+0.6;

		$jquerywud = get_option('grid_wud_slider');
		$jq_script = '<script type="text/javascript" src="'.$jquerywud.'"></script>';
		echo $jq_script;

	if($posts){	
		$todisplay .= "<!-- Grid WUD Version ".$gwfuncs['grid_wud_version']."-->";
		$todisplay .= "<div id='grid_wud_fade_home' class='no-js'><div class='grid-wud-container'>";	
		$todisplay .= "<div class='grid-wud-h1' style='line-height:".$lineheight."vw; font-size:".$gwfuncs['grid_wud_h1_font_size']."vw; background-color:".$gwfuncs['grid_wud_cat_bcolor'].";'><a href='".$wud_cat_or_term_url."' style='text-decoration: none; color:".$gwfuncs['grid_wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</a></div>";
		$todisplay .= '<div id="wud_stage" class="stage'.$count_banner.'">';
		foreach ($posts as $post) {	
			$popup_array = collectimages($post);	
			$wud_feat_image = $popup_array['feat_img'];	
			$posttype = get_post_type( $post->ID );
			
			if(!empty($post->post_excerpt)){$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_excerpt, 30 ) );}
			else{$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_content, 30 ) );}
			$pattern = '~http(s)?://[^\s]*~i';
			$wud_excerpt = preg_replace($pattern, '', $wud_excerpt);
				//WooCommerce is used
				if($posttype=="product"){
					$woocommerce =  $post->ID;
					$woobutton = do_shortcode( '[product id="'.$woocommerce.'"]' );
					$woodisplay = "woomaxheight";
				}
				else{
					$woobutton = NULL;
					$woodisplay = NULL;
				}				
			$todisplay .= '<a href="'.@get_permalink($post->ID).'"><div class="wud_slide" style="background-image:url('.$wud_feat_image.')"><div class="wud_excerpt"><strong>'.$post->post_title.'</strong><br>'.$wud_excerpt.$woobutton.'<a href="'.@get_permalink($post->ID).'"id="WudButtonBannerCss">Read More ...</a>'.'</div></div></a>';
		}	
			$todisplay .=  '<div class="wud_next"></div><div class="wud_prev"></div></div>';
			$todisplay .= '<script type="text/javascript">wud_slider(\'.stage'.$count_banner.'\', \''.$bannerheight.'\');</script>';
			$todisplay .=  '</div></div>';
	}

	return $todisplay;
}		
?>