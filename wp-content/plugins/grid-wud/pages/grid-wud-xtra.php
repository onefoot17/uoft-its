 <?php
 /*
=== Grid WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
include( filter_var($parse_uri[0] . 'wp-load.php', FILTER_SANITIZE_STRING) );	
//Let's start again from here!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	if($_POST){	$grid_wud_or_popup = trim(filter_var($_POST['popup'], FILTER_SANITIZE_STRING));	}
	if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
		$jquerywud = get_option('grid_wud_def_jq');
		$jq_script = '<script type="text/javascript" src="'.$jquerywud.'"></script>';
		echo $jq_script;
	}		
	if($_POST)
	{
		$grid_wud_set_max_grid = trim(filter_var($_POST['grid_wud_set_max_grid'], FILTER_SANITIZE_STRING));
		$tags = trim(filter_var($_POST['grid_wud_tags'], FILTER_SANITIZE_STRING));
		$cats = trim(filter_var($_POST['grid_wud_cats'], FILTER_SANITIZE_STRING));
		$cat_found = trim(filter_var($_POST['cat_found'], FILTER_SANITIZE_STRING));
		$tag_found = trim(filter_var($_POST['tag_found'], FILTER_SANITIZE_STRING));
		$ids = unserialize(filter_var($_POST['grid_wud_ids'], FILTER_SANITIZE_STRING));
		$wud_grid_nr = trim(filter_var($_POST['grid_wud_grid_nr'], FILTER_SANITIZE_STRING));
		$wud_grid_shape = trim(filter_var($_POST['grid_wud_shape'], FILTER_SANITIZE_STRING));
		$wud_grid_latest = trim(filter_var($_POST['grid_wud_latest'], FILTER_SANITIZE_STRING));
		$grid_wud_shadow = trim(filter_var($_POST['grid_wud_shadow'], FILTER_SANITIZE_STRING));
		$posttype = trim(filter_var($_POST['posttype'], FILTER_SANITIZE_STRING));
		$tax_name = trim(filter_var($_POST['tax_name'], FILTER_SANITIZE_STRING));
		$pods_cat = explode(" ",filter_var($_POST['pods_cat'], FILTER_SANITIZE_STRING));
		$pods_is_used = trim(filter_var($_POST['pods_is_used'], FILTER_SANITIZE_STRING));
		$is_numbers = trim(filter_var($_POST['is_numbers'], FILTER_SANITIZE_STRING));
		$postids = explode(" ",filter_var($_POST['postids'], FILTER_SANITIZE_STRING));
		$background = trim(filter_var($_POST['background'], FILTER_SANITIZE_STRING));
		$tiles = trim(filter_var($_POST['tiles'], FILTER_SANITIZE_STRING));
		$dark_excerpt = trim(filter_var($_POST['dark_excerpt'], FILTER_SANITIZE_STRING));
		$grid_wud_gray = trim(filter_var($_POST['no_gray'], FILTER_SANITIZE_STRING));
		$grid_wud_or_woo = trim(filter_var($_POST['grid_wud_or_woo'], FILTER_SANITIZE_STRING));
		
		$order_by = trim(filter_var($_POST['order_by'], FILTER_SANITIZE_STRING));
		$order_sort = trim(filter_var($_POST['order_sort'], FILTER_SANITIZE_STRING));
		
		$stickyleft = unserialize(filter_var($_POST['stickyleft'], FILTER_SANITIZE_STRING));
		$sticky = trim(filter_var($_POST['sticky'], FILTER_SANITIZE_STRING));
		
		echo wud_grid_wud__more_post();
		echo '</div>';
	}


// Get the 'see more' image
	function wud_grid_wud__more_post(){
		global $cat_found, $grid_wud_or_popup, $tag_found, $grid_wud_or_woo, $grid_wud_gray, $dark_excerpt, $sticky, $stickyleft, $order_by, $order_sort, $result, $args, $grid_wud_set_max_grid, $tags, $cats, $ids, $wud_grid_nr, $gwfuncs, $wud_grid_shape, $grid_wud_shadow, $posttype, $tax_name, $pods_cat, $pods_is_used, $is_numbers, $postids, $background, $tiles;	 
		$grids=0;
		$bgcs="#fff";
		//Disable random read order by read more click
		if($order_by=="rand"){$order_by="date";}
		//Get the category or tag by name
		$wud_cat_or_term_name =$gwfuncs['grid_wud_news_title'];
		if (!empty( $cats )){
			//Category to post
			if($cat_found == "categories"){
				$wud_cat_or_term_name = get_term_by('id', $cats, 'categories')->name;
			}
			//Woocommerce
			elseif($cat_found == "product_cat"){
				$cat_found = "product_cat";
				$wud_cat_or_term_name = get_term_by('term_id', $cats, 'product_cat')->name;
			}	
			//WP			
			else{
				$cat_found = "category";
				$wud_cat_or_term_name = get_the_category_by_ID($cats );
			}
			}
		elseif (!empty( $tags )){
			//Category to post
			if($tag_found == "tags"){
				$wud_cat_or_term_name = get_term_by('id', $tags, 'tags')->name;
			}
			//Woocommerce
			elseif($tag_found == "product_tag"){
				$tag_found = "product_tag";
				$wud_cat_or_term_name = get_term_by('term_id', $tags, 'product_tag')->name;
			}
			//WP			
			else{
				$tag_found = "post_tag";
				$wud_cat_or_term_name = get_term_by('term_id', $tags, 'post_tag')->name;
			}
			}

		
		//Post type Pods
		if ($pods_is_used=="1"&& $is_numbers =="0"){
			if(empty($pods_cat[0]) && $cats=="0" && $tags=="0"){
		//Show all Pods
				$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );				
			}
			else{
		//Show Pods by Taxonomy --> category (categories)
				$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => $tax_name, 'field' => 'slug', 'terms' => $pods_cat)), 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
			}
		}
		//WP or Custom POST by category
		elseif (!empty( $cats ) && $cats !="0" && $cat_found == "category")
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'category' => $cats, 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'category' => $cats, 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
			}
		//WUD Custom PAGE by category
		elseif (!empty( $cats ) && $cats !="0" && $cat_found == "categories")
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "categories", 'field' => 'ID', 'terms' => array($cats))), 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "categories", 'field' => 'ID', 'terms' => array($cats))), 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
			}

		//WUD Custom Post by Woocommerce category
		elseif (!empty( $cats ) && $cats !="0" && $cat_found == "product_cat")
			{
				
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "product_cat", 'field' => 'ID', 'terms' => array($cats))), 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "product_cat", 'field' => 'ID', 'terms' => array($cats))), 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
			}
			
		//WP or Custom Post by tag
		elseif (!empty( $tags ) && $tags !="0" && $tag_found == "post_tag")
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tag_id' => $tags, 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tag_id' => $tags, 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}					
			}	
		//WUD Custom Post by tag
		elseif (!empty( $tags ) && $tags !="0" && $tag_found == "tags")
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "tags", 'field' => 'ID', 'terms' => array($tags))), 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "tags", 'field' => 'ID', 'terms' => array($tags))), 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}					
			}
		//WP or Custom Post by Woocommerce tag
		elseif (!empty( $tags ) && $tags !="0" && $tag_found == "product_tag")
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "product_tag", 'field' => 'ID', 'terms' => array($tags))), 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_sort );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'tax_query' => array(array('taxonomy' => "product_tag", 'field' => 'ID', 'terms' => array($tags))), 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}					
			}
			
		//WP post by given id's
		elseif (!empty( $is_numbers ) && $is_numbers !="0"){
			//post__in and post__not_in cannot used togheter, so search for the difference ... in the arrays at display
			$clean1 = array_diff($postids, $ids); if (empty($clean1)){$clean1=array('0');}
			$args = array( 'post_status' => 'publish', 'post__in' => $clean1, 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid,'orderby' => 'post__in' );
			
		}
			//WP or Custom Post all posts
		else
			{
				if($sticky==0){
					$args = array( 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'post__not_in'=>$ids, 'orderby'=> $order_by, 'order'=> $order_by );
				}
				else{
					$args = array( 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'post_type' => $posttype, 'posts_per_page' => $grid_wud_set_max_grid , 'post__in'=>$stickyleft, 'orderby'=> $order_by, 'order'=> $order_sort );
				}				
			}

//Show the result			
			$myposts = get_posts( $args );
		
			if(isset($myposts)){	
	
			foreach ( $myposts as $post ) : setup_postdata( $post );
			//$posttype = get_post_type( $post->ID );
				if ($wud_grid_nr>20){$wud_grid_nr=1;}
				if($wud_grid_shape == 4){$circle="gridis='circle'";} else{$circle="";}
			 if(post_type_exists( $posttype )){	
				if($posttype !="page" && $posttype !="post"){
					$wud_link = @get_post_permalink($post->ID);
				}
				else{
					$wud_link = @get_permalink($post->ID);
				}				
			} 
			else{
				$wud_link = "#_";
			}
				$wud_title = $post->post_title;
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
				if($gwfuncs['grid_wud_show_excerpt']=='1' || $gwfuncs['grid_wud_show_excerpt']=='2' || $gwfuncs['grid_wud_show_excerpt']=='3' || $gwfuncs['grid_wud_show_excerpt']=='4'){				
					//If the real WP excerpt exist (fil in with your own content)
					if(!empty($post->post_excerpt)){$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_excerpt, $gwfuncs['grid_wud_excerpt_words'] ) );}
					//Else we make our own excerpt from the content
					else{$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_content, $gwfuncs['grid_wud_excerpt_words'] ) );}
						//Remove http and https URLS from the excerpt
						$pattern = '~http(s)?://[^\s]*~i';
						$wud_excerpt= preg_replace($pattern, '', $wud_excerpt);	
				}
					//wud_excerpt_popup for java script popup
					if(!empty($post->post_excerpt)){$wud_excerpt_popup = strip_shortcodes ( wp_trim_words ( $post->post_excerpt, $gwfuncs['grid_wud_excerpt_words'] ) );}
					else{$wud_excerpt_popup = strip_shortcodes ( wp_trim_words ( $post->post_content, $gwfuncs['grid_wud_excerpt_words'] ) );}
						$pattern = '~http(s)?://[^\s]*~i';
						$wud_excerpt_popup = $woobutton.preg_replace($pattern, '', $wud_excerpt_popup);
						
					$wud_feat_image=NULL;
				//Collect the image(s)
					$popup_array = collectimages($post);	
					$wud_feat_image = $popup_array['feat_img'];
					
					if($popup_array['popup_img']){$wud_popup_image = $popup_array['popup_img'];}
					else{$wud_popup_image = $popup_array['feat_img'];}

	
					$result .= "<!-- Grid WUD Version ".$gwfuncs['grid_wud_version']."-->";
			if($gwfuncs['grid_wud_show_grid_button']==""){$readmorewud = " + ";} else{$readmorewud = $gwfuncs['grid_wud_show_grid_button'];}
			if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$result .= "<div class='wud-url'><a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".$wud_link."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' >";
			}
			else{
				$result .= "<div class='wud-url'><a href='".$wud_link."' title='' alt=''>";	
			}						
		
			//-> Wrapper-start
			
		// ###### CIRCLE ###### ($grid_wud_shadow is DEMO variable from: grid-wud-base.php --> grid-wud.js --> HERE) ######
			if($wud_grid_shape == "4" && $background == "0" ){
				//GRIDS 

					if($gwfuncs['grid_wud_img_split'] == 0 && $gwfuncs['grid_wud_shadow'] == 0){
						$grids=0;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 1 && $gwfuncs['grid_wud_shadow'] == 0){
						$grids=1;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 0 && $gwfuncs['grid_wud_shadow'] == 1){
						$grids=0;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 1 && $gwfuncs['grid_wud_shadow'] == 1){
						$grids=2;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}
								
				if($grids==0 ){
					$result .= "<div ".$circle." class='grid-wud-wrapper' id='grid-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 			
				}
				//TILES
				else{
					// shadow
					if($grids==2){
					$result .= "<div ".$circle." class='grid-wud-wrapper grid-wud-wrapper-box' id='tile-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 			
					}
					//no shadow
					else{
					$result .= "<div ".$circle." class='grid-wud-wrapper' id='tile-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 			
					}					
				}				
			}
		// ###### SQUARE ###### ($grid_wud_shadow is DEMO variable from: grid-wud-base.php --> grid-wud.js --> HERE) ######
			else{
				//GRIDS

					if($gwfuncs['grid_wud_img_split'] == 0 && $gwfuncs['grid_wud_shadow'] == 0){
						$grids=0;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 1 && $gwfuncs['grid_wud_shadow'] == 0){
						$grids=1;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 0 && $gwfuncs['grid_wud_shadow'] == 1){
						$grids=0;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}

					if($gwfuncs['grid_wud_img_split'] == 1 && $gwfuncs['grid_wud_shadow'] == 1){
						$grids=2;
						if($tiles==0){	$grids=0; }
						elseif($tiles==1){ $grids=1; }
						elseif($tiles==2){ $grids=2; }						
					}
								
				if($grids==0 ){
					$result .= "<div ".$circle." class='grid-wud-wrapper' id='grid-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px; webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px; moz-border-radius:".$gwfuncs['grid_wud_round_img']."px; ' >"; 			
				}
				//TILES
				else{ 
					// shadow
					if($grids==2){
					$result .= "<div ".$circle." class='grid-wud-wrapper grid-wud-wrapper-box' id='tile-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px; webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px; moz-border-radius:".$gwfuncs['grid_wud_round_img']."px;  ' >"; 			
					}
					// no shadow
					else{
					$result .= "<div ".$circle." class='grid-wud-wrapper' id='tile-".$wud_grid_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px; webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px; moz-border-radius:".$gwfuncs['grid_wud_round_img']."px; ' >"; 			
					}					
				}			
			}	
			
			//-> Image-start & end
			if($wud_grid_shape == "4" && $background == "0" ){
					$result .= "<div class='grid-wud-image ".$grid_wud_gray."' style='background-image:url(".$wud_feat_image."); border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; '></div>";
			}
			else{
				if($background== "0"){
					$result .= "<div class='grid-wud-image ".$grid_wud_gray."' style='background-image:url(".$wud_feat_image."); '></div>";
				}
			}			
						
			//Show the category on the grid
					if($gwfuncs['grid_wud_hide_grid_cat']==0 || !$gwfuncs['grid_wud_hide_grid_cat'] || $gwfuncs['grid_wud_hide_grid_cat']==''){}
					else{ //show is value 1
						if ($wud_grid_shape != 4 ){
								$result .= "<div id='grid-wud-h4-top' class='grid-wud-h4' style='font-size:16px; height:26px; text-overflow: ellipsis; overflow: hidden;white-space: nowrap; width: 80%; margin-left: 0.5%;'>".$wud_cat_or_term_name."</div>";
						}
					}
			
				//Switch background color
				if($gwfuncs['grid_wud_rev_back']==1){$background_switch="grid-wud-primary-color";}
				else{$background_switch="grid-wud-standard-color";}
				if($dark_excerpt==1){$background_switch="grid-wud-primary-color";}
				if($dark_excerpt==0){$background_switch="grid-wud-standard-color";}
				if($posttype=="product"){$background_switch .= " wooexcerpt";}
				
	$result .= "</a>";
			if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$wud_excerpt  = "<a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".$wud_link."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>"; 
			}
			else{	
				$wud_excerpt = "<a href='".$wud_link."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>";
			}			
	
	$wud_post_title = "<a href='".$wud_link."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'><b>".$post->post_title."</b></a><br>";
	if($posttype=="product" && $grid_wud_or_woo != 6 && $grid_wud_or_woo != 7){$wud_post_title  = NULL;}
	
			//-> The excerpt text
			if ($wud_grid_shape != 4 && $background== 0 ){		
				// Show excerpt text
				if($grid_wud_or_woo==1){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '>".$woobutton.$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($grid_wud_or_woo==2 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '>".$woobutton.$wud_post_title.$wud_excerpt."</div>";					
				}
				// Show excerpt text and title allways
				elseif ($grid_wud_or_woo==3 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt-2 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '>".$woobutton.$wud_post_title.$wud_excerpt."</div>";						
				}
				// Show excerpt title
				elseif ($grid_wud_or_woo==4 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt-3 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '>".$woobutton.$wud_post_title."</div>";						
				}	
				// Show Woocommerce excerpt text and title allways
				elseif ($grid_wud_or_woo==5 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt-5 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$woobutton."<div class='woohide'>".$wud_excerpt."</div></div>";						
				}	
				// Hide Woocommerce excerpt text and title
				elseif ($grid_wud_or_woo==6 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt-6 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'><div class='wootitle'>".$wud_post_title."</div>".$woobutton.$wud_excerpt."</div>";						
				}	
				// Hide Woocommerce excerpt text and title
				elseif ($grid_wud_or_woo==7 ){
					$result .= "<div id='".$woodisplay."' class='grid-wud-excerpt-6 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$wud_post_title."</div>";						
				}					
			}
			elseif ($wud_grid_shape == 4 && $background == "0" ){
					if($gwfuncs['grid_wud_show_excerpt']==1){ 
						$result .= "<div class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important;'>".$wud_excerpt."</div>";	
					}
					// Show excerpt text and title
					elseif ($gwfuncs['grid_wud_show_excerpt']==2 ){
						$result .= "<div class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important;'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";					
					}
					// Show excerpt text and title allways
					elseif ($gwfuncs['grid_wud_show_excerpt']==3 ){
						$result .= "<div class='grid-wud-excerpt-2 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important;'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";						
					}
					// Show excerpt title
					elseif ($gwfuncs['grid_wud_show_excerpt']==4 ){
						if($gwfuncs['grid_wud_title_topmid']<>4){
						$result .= "<div class='grid-wud-excerpt-3 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding-top: 20px; padding-bottom: 20px; text-align: center !important; '><b>".$post->post_title."</b></div>";						
						}
						else{
						$result .= "<div class='grid-wud-excerpt-3 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important;'><b>".$post->post_title."</b></div>";							
						}
					}					
				}
			else{
				// Show excerpt text
				if($background > 10){
					$hoverimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/empty-txt.png';
					if($background==11){$bgcs=$gwfuncs['grid_wud_bgc1'];}
					elseif($background==12){$bgcs=$gwfuncs['grid_wud_bgc2'];}
					elseif($background==13){$bgcs=$gwfuncs['grid_wud_bgc3'];}
					elseif($background==14){$bgcs=$gwfuncs['grid_wud_bgc4'];}
					elseif($background==15){$bgcs=$gwfuncs['grid_wud_bgc5'];}					
					$result .= "<div onMouseOver=\"this.style.backgroundImage='url(\'".$hoverimg."\')';\" onMouseOut=\"this.style.backgroundImage='none';\" class='grid-wud-excerpt-2-no' style='background-color: ".$bgcs."; font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '>".$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($background < 6 ){
					$hoverimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/empty-txt.png';
					if($background==1){$bgcs=$gwfuncs['grid_wud_bgc1'];}
					elseif($background==2){$bgcs=$gwfuncs['grid_wud_bgc2'];}
					elseif($background==3){$bgcs=$gwfuncs['grid_wud_bgc3'];}
					elseif($background==4){$bgcs=$gwfuncs['grid_wud_bgc4'];}
					elseif($background==5){$bgcs=$gwfuncs['grid_wud_bgc5'];}					
					$result .= "<div onMouseOver=\"this.style.backgroundImage='url(\'".$hoverimg."\')';\" onMouseOut=\"this.style.backgroundImage='none';\" class='grid-wud-excerpt-2-no' style='background-color: ".$bgcs."; font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; '><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";					
				}				
			}
		//-> Wrapper-end
					$result .= "</div>"; 
				$result .= "</div>";	
				$wud_grid_nr++; 
			endforeach; 
			wp_reset_postdata();
			}			
		return $result;
	}	
	
?>