<?php
 /*
=== Grid WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
function grid_wud_comm( $atts ) {
	// If wrong apostrophes are used
	$find = array('/″/', '/”/', '/"/');	
	$atts = preg_replace($find, '', $atts);
	
	//If template file = archive.php, don't generate the short code
	global $template;
    $temp = basename($template);
	if($temp=="archive.php"){return;}
	
	//Start short code extracting
	extract( shortcode_atts(array('slug' => '','bannerheight' => '','skip' => '','popup' => '','woocss' => '','gray' => '','group' => '','dark' => '','hgb' => '','nofeatimg' => '','grid' => '','button' => '','cp' => '','pods' => '','shape' => '','nowidget' => '','title' => '','bg' => '','tiles' => '','order' => '','sticky' => ''), $atts ));
    // slug: category or tag
	// grid: quantity to display
	// button: display/hide the button
	// cp: custom post type
	// pods: Pods - Custom Content Types and Fields
	// shape: number of shape to show
	// nowidget: display real tiles on widget pages	
	global $gwfuncs, $widgetfront, $wud_cat_or_term_url, $pods_is_used, $wp_cat, $totalgrids, $wud_quantity, $grid_wud_sticky, $count_cats_tags, $nofeatimg, $groups, $banner_height, $banner_slider;
	global $Xpost, $Tpost, $grid_wud_widget, $pods, $wud_grid_nr,$grid_ids, $posttype, $tax_name, $pods_cat, $cat_id, $totalgroups, $thumbs, $wud_cat_or_term_name, $grid_wud_or_popup, $custom_title ;
	global $tag_id, $wud_latest_post, $is_numbers, $grid_wud_shape, $tiles, $postids, $background, $grids, $grid_wud_button, $slugs, $button_act, $hide_group_button, $grid_wud_or_woo;
	global $args1, $args2, $args3, $args4, $args5, $args6, $args7, $args8, $args9, $args10, $cat_found, $term_found, $dark_excerpt, $woocommerce, $woobutton, $woodisplay, $grid_wud_gray;
	// No Global	
	$term = NULL ;
	$PodsIdObj=NULL;
	$cat_tag = NULL;
	$custom_title=NULL;
	$stickytot=array();
	$stickyleft=array();	
	$posts = null ;
	$skip = 0;
	
	// Globals
	//-> $grid_wud_widget value from main file
	$grid_ids = NULL;	
	$posttype = NULL ;	
	$tax_name = NULL ;		
	$wp_cat = array();
	$pods_cat = array() ;
	$pods_is_used="0";	
	$cat_id = 0;
	$tag_id = 0;
	$wud_latest_post="0";
	$grid_wud_shape = $gwfuncs['gwcss'];
	$tiles= 9;	
	$is_numbers=0;
	$postids = array() ;
	$background = 0;	
	$grids=0;
	$grid_wud_button=9; 
	$slugs=NULL;	
	$button_act=0;	
	$grid_wud_sticky = 0;	
	$totalgroups=0;
	$wud_grid_nr=0;
	$Xpost = 0;
	$Tpost = 0;
	$count_cats_tags = 0;
	$wud_quantity = 0;
	$totalgrids = 0;
	$widgetfront = 0;
	$thumbs= get_intermediate_image_sizes();
	$hide_group_button = 0;
	$nofeatimg = 0;
	$groups = array() ;
	$args1=array();
	$args2=array();
	$args3=array();
	$args4=array();
	$args5=array();
	$args6=array();
	$args7=array();
	$args8=array();
	$args9=array();
	$args10=array();
	$cat_found = NULL;
	$term_found = NULL;
	$dark_excerpt = 9;
	$woocommerce = 0;
	$woobutton = NULL;
	$woodisplay = NULL;
	$grid_wud_gray = NULL;
	$grid_wud_or_popup = 0;
	$grid_wud_or_woo = 0;
	//Sorting order can be changed by [order=""]
	$order_by = $gwfuncs['grid_wud_set_order_grid']; 
	$order_sort = $gwfuncs['grid_wud_set_dir_grid'];
	$banner_height = 33;
	$banner_slider = 0;

	//If pods is used
		if(isset($atts["pods"]) && $atts["pods"]!='' && class_exists( 'PodsInit' )){
			if(is_numeric($atts["pods"]) && $atts["pods"] > 0 && $atts["pods"] == round($atts["pods"], 0)){
				if($atts["pods"] > 2){$atts["pods"] = 1;}
				$pods_is_used="1";
			}
			else{
				$atts["pods"] = 1;
				$pods_is_used="1";
				}
		}

	//If custom post is used
		if(isset($atts["cp"]) && $atts["cp"]!='' ){
			if(is_numeric($atts["cp"]) && $atts["cp"] > 0 && $atts["cp"] == round($atts["cp"], 0)){
				if($atts["cp"] > 2){$atts["cp"] = 1;}
			}
			else{$atts["cp"] = 1;}
		}
		
	//If dark expert background is used
		if(isset($atts["dark"]) && $atts["dark"]!='' ){
			if(is_numeric($atts["dark"]) && $atts["dark"] > 0 && $atts["dark"] == round($atts["dark"], 0)){
				if($atts["dark"] > 1){$atts["dark"] = 0;}
				$dark_excerpt = $atts["dark"];
			}
			else{$dark_excerpt = 0;}
		}	

	//If gray is used
		if(isset($atts["gray"]) && $atts["gray"]!='' ){
			if(is_numeric($atts["gray"]) && $atts["gray"] >= 1 && $atts["gray"] == round($atts["gray"], 0)){
				$grid_wud_gray = "no-gray-just-color";
				$atts["gray"] = 1; 
			}
			else{$grid_wud_gray = "no-color-just-grey";}
		}

	//If Banner height is used
		if(isset($atts["bannerheight"]) && $atts["bannerheight"]!='' ){
			if(is_numeric($atts["bannerheight"]) && $atts["bannerheight"] >= 1 && $atts["bannerheight"] == round($atts["bannerheight"], 0)){
				if($atts["bannerheight"] < 33 || $atts["bannerheight"] > 100){$banner_height = 33;}
				else{$banner_height = $atts["bannerheight"];}				
			}
		}
		
	//If show is used
		if(isset($atts["woocss"]) && $atts["woocss"]!='' ){
			if(is_numeric($atts["woocss"]) && $atts["woocss"] >= 1 && $atts["woocss"] == round($atts["woocss"], 0)){
				if($atts["woocss"] > 3){$grid_wud_or_woo = 1;}
				else{$grid_wud_or_woo = $atts["woocss"];}				
			}
		}
		
	//If popup is used
		if(isset($atts["popup"]) && $atts["popup"]!='' ){
			if(is_numeric($atts["popup"]) && $atts["popup"] >= 1 && $atts["popup"] == round($atts["popup"], 0)){
				if($atts["popup"] > 2){$grid_wud_or_popup = 0; $banner_slider = 0;}
				elseif($atts["popup"] == 2){$banner_slider = 1; $grid_wud_or_popup = 0;}
				elseif($atts["popup"] == 1){$banner_slider = 0; $grid_wud_or_popup = 1;}
									   else{$banner_slider = 0; $grid_wud_or_popup = 0;}
			}
		}
		
	//If custom post is used
		if(isset($atts["title"]) && $atts["title"]!='' ){
				$custom_title = trim(filter_var($atts["title"], FILTER_SANITIZE_STRING));
		}

	//If custom CSS (grids/tiles) is used
		if(isset($atts["tiles"]) && $atts["tiles"]!='' ){
			if(is_numeric($atts["tiles"]) && $atts["tiles"] >= 0 && $atts["tiles"] == round($atts["tiles"], 0)){
				if($atts["tiles"] > 2){$atts["tiles"] = 0;}
				$tiles=$atts["tiles"];
			}
		}
		
	//If bg is used
		if(isset($atts["bg"]) && $atts["bg"]!='' ){
			if(is_numeric($atts["bg"]) && $atts["bg"] > 0 && $atts["bg"] == round($atts["bg"], 0)){
				$bgc = array("1","2","3","4","5","11","12","13","14","15");
				if (in_array($atts["bg"], $bgc)) { $background=$atts["bg"]; }
			}
		}
		
	//Show the style
		if(isset($atts["shape"]) && $atts["shape"]!='' ){
			if(is_numeric($atts["shape"]) && $atts["shape"] > 0 && $atts["shape"] == round($atts["shape"], 0)){
				$gwfuncs['gwcss'] = $atts["shape"];
				if($gwfuncs['gwcss'] > 8){$gwfuncs['gwcss'] = 1;}
			}
			//If EMPTY shape is entered: use the global default value
			else{
				$gwfuncs['gwcss'] = grid_wud_current_style();
			}
			$grid_wud_shape=$gwfuncs['gwcss'];
		}
		//If shape is NOT USED: use the global default value
		else{
			$gwfuncs['gwcss'] = grid_wud_current_style();
			$grid_wud_shape=$gwfuncs['gwcss'];
		}
		
// Read the Array data (Category or Tag)
	if((isset($atts["slug"]) && $atts["slug"]!='' ) || (isset($atts["ids"]) && $atts["ids"]!='' )){
	//Make var empty
		 
		$grid_wud_skip_post=$gwfuncs['grid_wud_skip_post'];

	//Show the button (yes/no)
		if(isset($atts["skip"]) && $atts["skip"]!='' ){
			if(is_numeric($atts["skip"]) && $atts["skip"] > 0 && $atts["skip"] == round($atts["skip"], 0)){
				$grid_wud_skip_post = $atts["skip"];
				if($grid_wud_skip_post > 10){$grid_wud_skip_post = 0;}
			}
		}		

	//If order is used
		if(isset($atts["order"]) && $atts["order"]!='' ){
			if(is_numeric($atts["order"]) && $atts["order"] > 0 && $atts["order"] == round($atts["order"], 0)){
				$wud_order = array("11","12","21","22","31","32","99");
				if (in_array($atts["order"], $wud_order)) { 
					if($atts["order"]==11){ $order_by='date'; $order_sort='ASC'; }
					if($atts["order"]==12){ $order_by='date'; $order_sort='DESC'; }
					if($atts["order"]==21){ $order_by='name'; $order_sort='ASC'; }
					if($atts["order"]==22){ $order_by='name'; $order_sort='DESC'; }
					if($atts["order"]==31){ $order_by='ID'; $order_sort='ASC'; }
					if($atts["order"]==32){ $order_by='ID'; $order_sort='DESC'; }
					if($atts["order"]==99){ $order_by='rand'; $order_sort='ASC'; }
				}
			}
		}
		
	//Show the button (yes/no)
		if(isset($atts["button"]) && $atts["button"]!='' ){
			if(is_numeric($atts["button"]) && $atts["button"] > 0 && $atts["button"] == round($atts["button"], 0)){
				$grid_wud_button = $atts["button"];
				if($grid_wud_button > 2){$grid_wud_button = 0;}
			}
			//Else use the global default value
			else{
				$grid_wud_button = 0;
			}
		}
	
	//Sticky post only
		if(isset($atts["sticky"]) && $atts["sticky"]!='' ){
			if(is_numeric($atts["sticky"]) && $atts["sticky"] > 0 && $atts["sticky"] == round($atts["sticky"], 0)){
				$grid_wud_sticky = $atts["sticky"];
				if($grid_wud_sticky > 1){$grid_wud_sticky = 0;}
			}
			//Else use the global default value
			else{
				$grid_wud_sticky = 0;
			}
		}

	//Hide First Group button.
		if(isset($atts["hgb"]) && $atts["hgb"]!='' ){
			if(is_numeric($atts["hgb"]) && $atts["hgb"] > 0 && $atts["hgb"] == round($atts["hgb"], 0)){
				$hide_group_button = $atts["hgb"];
				if($hide_group_button > 1){$hide_group_button = 0;}
			}
			//Else use the global default value
			else{
				$hide_group_button = 0;
			}
		}


	//Disable that 'category featured images extended' can catch the featured image.
		if(isset($atts["nofeatimg"]) && $atts["nofeatimg"]!='' ){
			if(is_numeric($atts["nofeatimg"]) && $atts["nofeatimg"] > 0 && $atts["nofeatimg"] == round($atts["nofeatimg"], 0)){
				$nofeatimg = $atts["nofeatimg"];
				if($nofeatimg > 1){$nofeatimg = 0;}
			}
			//Else use the global default value
			else{
				$nofeatimg = 0;
			}
		}
		
	//grid quantity given by shortcode
		if(isset($atts["grid"]) && $atts["grid"]!='' ){
			if(is_numeric($atts["grid"]) && $atts["grid"] > 0 && $atts["grid"] == round($atts["grid"], 0)){
				$wud_quantity = $atts["grid"];
				if($wud_quantity > 50){$wud_quantity = 50;}
			}
		}
			//Else use the global default value
		else{
				$wud_quantity = $gwfuncs['grid_wud_set_max_grid'];
		}		
		
		
	//nowidget = if widget on page (not widget zone) force page layout
		if(isset($atts["nowidget"]) && $atts["nowidget"]!='' ){
			if(is_numeric($atts["nowidget"]) && $atts["nowidget"] > 0 && $atts["nowidget"] == round($atts["nowidget"], 0)){
				$widgetfront = $atts["nowidget"];
				if($widgetfront > 1){$widgetfront = 1;}
			}
			//Else use the global default value
			else{
				$widgetfront = 0;
			}
		}		

 	//If slug with ID's is used
		if($posts == null && isset($atts["slug"]) && $atts["slug"]!='' ){
			$postids = ctoarray($atts["slug"]);
			
				foreach ($postids as $postid) {	
					if(is_numeric($postid) && $postid > 0 && $postid == round($postid, 0)){
						$is_numbers=1;
					if((!get_post_status( $postid ) || get_post_type( $postid )!='post') && !is_search()){echo '<font color="red">ERROR_01 => '.__("The ID: ".$postid ." given in [gridwud slug=\"".$atts["slug"]."\"] is invalid.", "grid-wud").'</font>';return;}			
					}
				else{$is_numbers=0; break;}				
				wp_reset_postdata();
				}			
			$args = new WP_Query(array(
				'posts_per_page'       => $wud_quantity,
				'post_status'	=> 'publish',
				'post_type'		   => 'post',
				'ignore_sticky_posts' => 1,
				'post__in' => $postids,
				'orderby' => 'post__in'
			));
			
			if ($is_numbers==1){
				$posts = $args->get_posts();
				$Tpost= $args->found_posts;
				$Xpost= $args->post_count;
				} 	
			if ($posts == null && $is_numbers==1){echo '<font color="red">ERROR_02 => '.__("The ID given in [gridwud slug=\"".$atts["slug"]."\"] is invalid.", "grid-wud").'</font>';return;}				
		}	 

	//Custom Post Type
		if ($posts == null && isset($atts["cp"]) && $is_numbers==0 && ($atts["cp"]=="1" || $atts["cp"]=="2")){
		$term = post_type_exists($atts["slug"]);
		if ($term != 0 && $term != null) {
			$args = new WP_Query(array(
				'post_status'	=> 'publish',
				'offset'   => $grid_wud_skip_post,
				'posts_per_page'       => $wud_quantity,
				'post_type'		   => $atts["slug"],
				'orderby'          => $order_by,
				'order'            => $order_sort
			));
		
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			} 
		}
		 
		
	//Post type Pods (Projects)
		if (isset($atts["pods"]) &&  $pods_is_used=="1" && $is_numbers==0  ) {	
		$post_typ= post_type_exists($atts["slug"]); //'project'
		}
		
		if ($posts == null && $pods_is_used=="1"  && $is_numbers==0 && !empty($post_typ )  && $post_typ != null && get_post_type( get_the_ID() ) == $post_typ) {			
			$args = new WP_Query(array(
				'post_status'	=> 'publish',
				'offset'   => $grid_wud_skip_post,
				'posts_per_page'       => $wud_quantity,
				'post_type'		   => $atts["slug"],
				'orderby'          => $order_by,
				'order'            => $order_sort
			));	
 		
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			} 
	//Taxonomy Pods (Project Types (all categories from the Taxonomy))
		if ($posts == null &&  $pods_is_used=="1" && $is_numbers==0 ) {
		$taxono = get_terms( $atts["slug"], array(  'orderby'    => 'count') );
				foreach ($taxono as $taxonos) {	
				if(isset($taxonos->slug)){
					$tax_name = $atts["slug"];
					array_push($pods_cat, $taxonos->slug);
					}
				}		
			wp_reset_postdata();	
		}	
		
	//Category Pods (search by Taxonomy -> category)
		if ($posts == null &&  $pods_is_used=="1"  && $is_numbers==0 && empty($tax_name )  && $tax_name == null) {
			$args = array('posts_per_page'   => -1,	'post_status'	=> 'publish', 'post_type'   => '_pods_pod',);
			$podstype = get_posts( $args );
				foreach ($podstype as $pods_type) {	
					$tax=$pods_type->post_name;				
						if(term_exists($atts["slug"], $tax)){
							$tax_name=$pods_type->post_name;
						}
				}		
			wp_reset_postdata();
		}
	//Search and order the requested Pods
		if ($posts == null &&  $pods_is_used=="1"  && $is_numbers==0 && !empty($tax_name )  && $tax_name != null) {	
			//$pods_cat is used by Taxonomy or category search
			if(empty($pods_cat)){$pods_cat = array($atts["slug"]);}
			$args = new WP_Query(array(
				'post_status'	=> 'publish',
				'offset'   => $grid_wud_skip_post,
				'posts_per_page'       => $wud_quantity,
				'post_type'		   => $post_typ,
				'tax_query'		   => array(array('taxonomy' => $tax_name, 'field' => 'slug', 'terms' => $pods_cat)),
				'orderby'          => $order_by,
				'order'            => $order_sort
			));
 		
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			} 			

	//Group categories or tags used
		if ($posts == null && !empty( $atts["slug"] )  && $atts["slug"] != null && ($atts["slug"] == 'cat' || $atts["slug"] == 'tag') && !empty( $atts["group"] )  && $atts["group"] != null) { 
			$tgroup = NULL;
			$groups = ctoarray($atts["group"]);
			if(count($groups) > 10){
						echo '<font color="red">ERROR_05 => <br>'.__("The maximum group items is 10 categories or tags.", "grid-wud").'';
						echo '<br>'.__("Please adjust this quantity.", "grid-wud").'';
						echo '<br>'.__("You have used these categories /tags : ", "grid-wud").'<b>'.$atts["group"].'</b></font>';
						return;					
			}
			foreach ($groups as $group) {
					$catfound=0;
					$tagfound=0;
					if ($atts["slug"]=="cat"){$tgroup = term_exists($group, 'category');$catfound=1;}
					elseif ($atts["slug"]=="tag") {$tgroup = term_exists($group, 'post_tag');$tagfound=1;}
					
					if (!empty($group )  && $group != null && !empty($tgroup )  && $tgroup != null) {
						$totalgroups++;
						if($totalgroups==1){
							//remember the first cat/tag, to continue as $atts["slug"]
							$cat_tag=$group;
							//use $groups for grid-wud-groups.php							
						}
						if($catfound==1){
								$args = array(
									'post_status'	=> 'publish',
									'offset'   => $grid_wud_skip_post,
									'posts_per_page'       => $wud_quantity,
									'post_type' => array('post','page'),
									'tax_query'		   => array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => array($group))),
									'orderby'          => $order_by,
									'order'            => $order_sort
								);							
						}
						elseif($tagfound==1){
								$args = array(
									'post_status'	=> 'publish',
									'offset'   => $grid_wud_skip_post,
									'posts_per_page'       => $wud_quantity,
									'post_type' => array('post','page'),
									'tax_query'		   => array(array('taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => array($group))),
									'orderby'          => $order_by,
									'order'            => $order_sort
								);																						
							}						
								if($totalgroups==1){$args1=$args;}
							elseif($totalgroups==2){$args2=$args;}
							elseif($totalgroups==3){$args3=$args;}
							elseif($totalgroups==4){$args4=$args;}
							elseif($totalgroups==5){$args5=$args;}
							elseif($totalgroups==6){$args6=$args;}
							elseif($totalgroups==7){$args7=$args;}
							elseif($totalgroups==8){$args8=$args;}
							elseif($totalgroups==9){$args9=$args;}
							elseif($totalgroups==10){$args10=$args;}							
					}
					else{
						echo '<font color="red">ERROR_04 => <br>'.__("Please notice that categories and tags cannot be mixed in the short code: slug=\"cat\" or slug=\"tag\".", "grid-wud").'';
						echo '<br>'.__("The category/tag given in [gridwud <b>group=\"".$group."\"</b>] is invalid.", "grid-wud").'</font><br><br>';
						return;	
					}
					
			wp_reset_postdata();
			}
				//continue with $cat_tag (first found value)
				$atts["slug"]=$cat_tag;
		}

			
	//Category
		if ($posts == null) {
			$cat_found = NULL;
			if(term_exists($atts["slug"], 'category')){
				$term = term_exists($atts["slug"], 'category');
				$cat_found='category';
			}
		// Plugin: category-to-pages-wud
		elseif(term_exists($atts["slug"], 'categories') && get_option('cattopage_wud_unique')=="1"){
				$term = term_exists($atts["slug"], 'categories');
				$cat_found='categories';
			}
		}
		if ($posts == null && !empty($term )  && $term != null) { 
			$wp_cat = array($atts["slug"]);
			//If sticky post only
			if($grid_wud_sticky==1){
				if($order_by!='rand'){$order_by='date';}
				$sticky = get_option( 'sticky_posts' );		
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $cat_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));
				$stickytot = new WP_Query(array(
					'post_status'	=> 'publish',
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $cat_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
				));					
			}
			
			else{
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $cat_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));				
			}
			
			if(!empty($stickytot)){
				$totpost = wp_list_pluck( $stickytot->posts, 'ID' );
				$showpost = wp_list_pluck( $args->posts, 'ID' );
				$stickyleft = array_diff($totpost, $showpost);
			}
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			} 			

	//Tag
		if ($posts == null) {
			$term_found = NULL;
			if(term_exists($atts["slug"], 'post_tag')){
				$term = term_exists($atts["slug"], 'post_tag');
				$term_found='post_tag';
			}
		// Plugin: category-to-pages-wud
		elseif(term_exists($atts["slug"], 'tags') && get_option('cattopage_wud_unique')=="1"){
				$term = term_exists($atts["slug"], 'tags');
				$term_found='tags';
			}
		}
		if ($posts == null && !empty($term )  && $term != null) {	
			$wp_cat = array($atts["slug"]);
			//If sticky post only
			if($grid_wud_sticky==1){
				if($order_by!='rand'){$order_by='date';}
				$sticky = get_option( 'sticky_posts' );	
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $term_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));
				$stickytot = new WP_Query(array(
					'post_status'	=> 'publish',
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $term_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
				));				
			}
			else{
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('post','page'),
					'tax_query'		   => array(array('taxonomy' => $term_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));				
			}

			if(!empty($stickytot)){
				$totpost = wp_list_pluck( $stickytot->posts, 'ID' );
				$showpost = wp_list_pluck( $args->posts, 'ID' );
				$stickyleft = array_diff($totpost, $showpost);
			}
			
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			}

			
	//Latest post (all)
		if($posts == null && isset($atts["slug"]) && $atts["slug"]=='wud-latest' ){
			//Or random or date order by Latest News.
			if($order_by!='rand'){$order_by='date';}
			//If sticky post only
			if($grid_wud_sticky==1){
				$sticky = get_option( 'sticky_posts' );				
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'post',
					'orderby'          => $order_by,
					'order'            => 'DESC',
				));
				$stickytot = new WP_Query(array(
					'post_status'	=> 'publish',
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'post',
				));				
			}
			else{
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post_type'		   => 'post',
					'orderby'          => $order_by,
					'order'            => 'DESC',
					'ignore_sticky_posts' => true
				));				
			}

			if(!empty($stickytot)){
				$totpost = wp_list_pluck( $stickytot->posts, 'ID' );
				$showpost = wp_list_pluck( $args->posts, 'ID' );
				$stickyleft = array_diff($totpost, $showpost);
			}
			
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;			
			//echo "t Found= ".$Tpost." x Count= ".$Xpost." wud_quantity= ".$wud_quantity."<br>";
			}

			
//WooCommerce Category
		if ($posts == null) {
			$cat_found = NULL;
			if(term_exists($atts["slug"], 'product_cat')){
				$term = term_exists($atts["slug"], 'product_cat');
				$cat_found='product_cat';
			}
		}
		if ($posts == null && !empty($term )  && $term != null) { 
			$wp_cat = array($atts["slug"]);
		
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('product'),
					'tax_query'		   => array(array('taxonomy' => $cat_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));				
			 
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			}
			
//WooCommerce Tag
		if ($posts == null) {
			$term_found = NULL;
			if(term_exists($atts["slug"], 'product_tag')){
				$term = term_exists($atts["slug"], 'product_tag');
				$term_found='product_tag';
			}
		}
		if ($posts == null && !empty($term )  && $term != null) { 
			$wp_cat = array($atts["slug"]);
			
				$args = new WP_Query(array(
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'posts_per_page'       => $wud_quantity,
					'post_type' => array('product'),
					'tax_query'		   => array(array('taxonomy' => $term_found, 'field' => 'slug', 'terms' => array($atts["slug"]))),
					'orderby'          => $order_by,
					'order'            => $order_sort
				));				
			 
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;
			}
			
	//Woocommerce (all)
		if($posts == null && isset($atts["slug"]) && $atts["slug"]=='woocommerce' ){
			//Or random or date order by Latest News.
			if($order_by!='rand'){$order_by='date';}
			//If sticky post only
			if($grid_wud_sticky==1){
				$sticky = get_option( 'sticky_posts' );				
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'product',
					'orderby'          => $order_by,
					'order'            => 'DESC',
				));
				$stickytot = new WP_Query(array(
					'post_status'	=> 'publish',
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'product',
				));				
			}
			else{
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post_type'		   => 'product',
					'orderby'          => $order_by,
					'order'            => 'DESC',
					'ignore_sticky_posts' => true
				));				
			}

			if(!empty($stickytot)){
				$totpost = wp_list_pluck( $stickytot->posts, 'ID' );
				$showpost = wp_list_pluck( $args->posts, 'ID' );
				$stickyleft = array_diff($totpost, $showpost);
			}
			
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;			
			}			

	//Woocommerce (featured)
		if($posts == null && isset($atts["slug"]) && $atts["slug"]=='woofeatured' ){

			if($order_by!='rand'){$order_by='date';}
			//If sticky post only
			if($grid_wud_sticky==1){
				$sticky = get_option( 'sticky_posts' );				
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'tax_query' => array(
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => 'featured',
							),
						),					
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'product',
					'orderby'          => $order_by,
					'order'            => 'DESC',
				));
				$stickytot = new WP_Query(array(
					'post_status'	=> 'publish',
					'post__in' => $sticky,
					'ignore_sticky_posts' => 1,					
					'post_type'		   => 'product',
				));				
			}
			else{
				$args = new WP_Query(array(
					'posts_per_page'   => $wud_quantity,
					'tax_query' => array(
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => 'featured',
							),
						),										
					'post_status'	=> 'publish',
					'offset'   => $grid_wud_skip_post,
					'post_type'		   => 'product',
					'orderby'          => $order_by,
					'order'            => 'DESC',
					'ignore_sticky_posts' => true
				));				
			}

			if(!empty($stickytot)){
				$totpost = wp_list_pluck( $stickytot->posts, 'ID' );
				$showpost = wp_list_pluck( $args->posts, 'ID' );
				$stickyleft = array_diff($totpost, $showpost);
			}
			
			$posts = $args->get_posts();
			$Tpost= $args->found_posts;
			$Xpost= $args->post_count;			
			}
			
//-> START SHOW GRIDS - TILES
		if(isset($posts)){	
//echo 'T='.$Tpost.' S='.$Xpost.'<br>';
		$result = NULL; 
		$wud_cat_or_term_url = NULL;
		$count_cats_tags= substr(round(microtime(true) * 1000),10,3);
		// Remember current slug (cat_or_tag)
		if(isset($atts["slug"])){$slugs = $atts["slug"];} else{$slugs="No slug given";} 

		//Parameter to change: grid_wud_show_excerpt
		if($grid_wud_or_woo == 1){$grid_wud_or_woo = 5;}
		elseif($grid_wud_or_woo == 2){$grid_wud_or_woo = 6;}
		elseif($grid_wud_or_woo == 3){$grid_wud_or_woo = 7;}
		else{$grid_wud_or_woo=$gwfuncs['grid_wud_show_excerpt'];}
		$wud_cat_or_term_name= collectcattagtitle('title');	
		$wud_cat_or_term_url= collectcattagtitle('url');

//If banner launch function and exit.
			if ( $posts != null  && $banner_slider == 1) {
				return wud_grid_banners($posts, $banner_height);
			}	
			
//-> Container-start
			$result .= "<!-- Grid WUD Version ".$gwfuncs['grid_wud_version']."-->";		
			if($grid_wud_widget==0 ||  $widgetfront==1){
				//container position
					if($gwfuncs['grid_wud_container_pos']==0){$margin="margin:auto;";}
					elseif($gwfuncs['grid_wud_container_pos']==1){$margin="margin: auto 0px auto auto;";}
					elseif($gwfuncs['grid_wud_container_pos']==2){$margin="margin: auto auto auto 0px;";}
					else {$margin="margin:auto";}
				//container width in %
				if($gwfuncs['grid_wud_size_split']==0){
					$result .= "<div id='grid_wud_fade_home' class='no-js' style='width:".$gwfuncs['grid_wud_width']."% !important; ".$margin."' ><div class='grid-wud-container' style='font-family:".$gwfuncs['grid_wud_font_header']." !important;'>";
				}
				//container width in px
				else{
					$result .= "<div id='grid_wud_fade_home' class='no-js' style='width: 100% !important; max-width:".$gwfuncs['grid_wud_width_px']."px !important; ".$margin."' ><div class='grid-wud-container' style='font-family:".$gwfuncs['grid_wud_font_header']." !important;'>";
				}
			}
			else{
					$result .= "<div id='grid_wud_fade_home' class='no-js' ><div class='grid-wud-widget' style='font-family:".$gwfuncs['grid_wud_font_header']." !important;'>";
				}
			
			$lineheight=$gwfuncs['grid_wud_h1_font_size']+0.6;
				
//if groups is used
		if($totalgroups > 0){
				//Set buttons on top of the grids and collect data for grid-wud-groups.php
				$chbuttons = collectheaderbutton();
				$result .= $chbuttons;
		}
// End if groups is used

// CAT - TAG Title		
		     else{
			//Parameter hide category/tag title + back and font color
			if(($gwfuncs['grid_wud_hide_cat_tag_header']==0 || !$gwfuncs['grid_wud_hide_cat_tag_header'] || $gwfuncs['grid_wud_hide_cat_tag_header']=='') && $wud_cat_or_term_name!="" ){				 
			  if ($grid_wud_widget==0 ||  $widgetfront==1){
				if($gwfuncs['grid_wud_cat_url']==1 && $wud_cat_or_term_url!="#_"){
					$result .= "<div class='grid-wud-h1' style='line-height:".$lineheight."vw; font-size:".$gwfuncs['grid_wud_h1_font_size']."vw; background-color:".$gwfuncs['grid_wud_cat_bcolor'].";'><a href='".$wud_cat_or_term_url."' style='text-decoration: none; color:".$gwfuncs['grid_wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</a></div>";
				}
				else{
					$result .= "<div class='grid-wud-h1' style='line-height:".$lineheight."vw; font-size:".$gwfuncs['grid_wud_h1_font_size']."vw; background-color:".$gwfuncs['grid_wud_cat_bcolor']."; color:".$gwfuncs['grid_wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</a></div>";
				}
			  }
			  else{
				if($gwfuncs['grid_wud_cat_url']==1 && $wud_cat_or_term_url!="#_"){
					$result .= "<div class='grid-wud-h1' style='font-size:1.1vw; background-color:".$gwfuncs['grid_wud_cat_bcolor'].";'><a href='".$wud_cat_or_term_url."' style='text-decoration: none; color:".$gwfuncs['grid_wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</a></div>";
				}
				else{
					$result .= "<div class='grid-wud-h1' style='font-size:1.1vw; background-color:".$gwfuncs['grid_wud_cat_bcolor']."; color:".$gwfuncs['grid_wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</div>";
				}				  
			  }
			 }
			// End Parameter hide category/tag title + back and font color				 		 
			}
// End CAT - TAG Title	
			
			
		$result .= "<div class='grid_wud_master_".$count_cats_tags."' >";
		
			//Collect all the grids/tiles
			$collection1=collectgrids($posts);
			$result .= $collection1;
			$totalgrids= $wud_grid_nr;


		$result .= "</div>";
			$result .= "<div id='grid_wud_result_".$count_cats_tags."'></div>";
			$result .= "<div class='clear'></div>"; 
		//-> Read more-start & end
			
			//New since 1.08 read more button
			if(($grid_wud_widget==0 ||  $widgetfront==1)   && $grid_wud_button != 1 ){	
				//Collect the button
				$collection2=collectbutton();
				$result .= $collection2;			
			}
			// if button=1 (no button to display)
			else{$result .= "</div><div class='grid-wud-bottom'></div>";}
			//End grid_wud_fade_home
			$result .= "</div>";
//-> Container-end			
		}
//-> END SHOW GRIDS - TILES		
		else{if(!is_search()){$result = '<font color="red">ERROR_03 => '.__("The ID given in [gridwud slug=\"".$atts["slug"]."\"] is invalid.", "grid-wud").'</font>';}}	
		wp_reset_postdata();
	}
		
	if(isset($result)){return $result;}
}

//================= Functions =================//

//Collect Cat/Tag Title
function collectcattagtitle($ctid){
	global $cat_found, $CatIdObj, $TagIdObj, $pods_cat, $slugs, $tax_name, $PodsIdObj, $atts, $term_found, $gwfuncs, $custom_title, $cat_id, $tag_id;
		//Category to post
		if($cat_found=="categories"){
			$CatIdObj = get_term_by('slug', $slugs, $cat_found);
		}
		//Woocommerce
		elseif($cat_found=="product_cat"){
			$CatIdObj = get_term_by('slug', $slugs, $cat_found);
		}
		//WP
		else{
			$CatIdObj = get_category_by_slug($slugs);
		}
		
		//Category to post
		if($term_found == "tags"){
			$TagIdObj = get_term_by('slug', $slugs, $term_found);
		}
		//Woocommerce
		elseif($term_found == "product_tag"){
			$TagIdObj = get_term_by('slug', $slugs, $term_found);
		}	
		//WP		
		else{
			$TagIdObj = get_term_by('slug', $slugs, "post_tag");
		}		
		
		//If Pods Taxonomy or category is used
		if(!empty($pods_cat) && $tax_name!=$slugs){$PodsIdObj = get_term_by('slug', $slugs, $tax_name);}
	    // Category or Tag Name
			$wud_cat_or_term_name = NULL; // Make the variable empty	
			if (!empty($CatIdObj)){$wud_cat_or_term_name = $CatIdObj->name;}
			if (!empty($TagIdObj)){$wud_cat_or_term_name = $TagIdObj->name;}
			if (!empty($PodsIdObj)){$wud_cat_or_term_name = $PodsIdObj->name;}
			if (empty($wud_cat_or_term_name)){
			  if($slugs!='wud-latest' ){	
				if ((isset($atts["cp"]) && $atts["cp"]=="1") || (isset($atts["pods"]) && $atts["pods"]=="1")){$wud_cat_or_term_name=$gwfuncs['grid_wud_cpt01'];}	
				elseif ((isset($atts["cp"]) && $atts["cp"]=="2") || (isset($atts["pods"]) && $atts["pods"]=="2")){$wud_cat_or_term_name=$gwfuncs['grid_wud_cpt02'];}
				else {$wud_cat_or_term_name="";}
			  }		  
			  else{
				// Latest post is active
				$wud_latest_post="1";
				$wud_cat_or_term_name= $gwfuncs['grid_wud_news_title'];  
			  }
			}
			if(!empty($custom_title)){$wud_cat_or_term_name=$custom_title;}
		// Category or Tag URL
				if(!empty($pods_cat) && $tax_name!=$slugs){
					$cat_id = $PodsIdObj->term_id; 
					$wud_cat_or_term_url = get_category_link( $cat_id);
				}
				elseif (!empty($CatIdObj)){
					$cat_id = $CatIdObj->cat_ID; 
					$wud_cat_or_term_url = get_category_link( $cat_id);
					if($cat_found=="categories"){
						$cat_id = $CatIdObj->term_id;
						$wud_cat_or_term_url = get_category_link( $cat_id);
					}
					if($cat_found=="product_cat"){
						$cat_id = $CatIdObj->term_id;
						$wud_cat_or_term_url = get_category_link( $cat_id);
					}					
				}
				elseif (!empty($TagIdObj)){
					$tag_id = $TagIdObj->term_id;
					$wud_cat_or_term_url = get_term_link( $tag_id);
				}
				else{
					//$result .= " -> Grids without category";
					}
				if (empty($wud_cat_or_term_url)){
					$wud_cat_or_term_url='#_';
					}
			if($ctid=='title'){return($wud_cat_or_term_name);}
			else{return($wud_cat_or_term_url);}	
}
//Collect group buttons
function collectheaderbutton(){
	global $gwfuncs, $groups, $count_cats_tags, $grid_wud_widget, $tiles, $background, $widgetfront, $grid_wud_shape, $grid_wud_button, $grid_wud_or_woo;
	global $args1, $args2, $args3, $args4, $args5, $args6, $args7, $args8, $args9, $args10, $hide_group_button, $dark_excerpt, $grid_wud_or_popup;
		$lineheight=$gwfuncs['grid_wud_h1_font_size']+1;
		$hb_result=NULL;	 
		$cnt_button=0;

		$hb_result .= "<form method='post' id='group_wud_form'>";				 
				 foreach ($groups as $group) {
					$cnt_button++;
					$wud_cat_or_term_name=NULL;
					//$myurl.. is used by the JavaScript to change the button URL only in id="group_button_.."
					$myurl1="#";$myurl2="#";$myurl3="#";$myurl4="#";$myurl5="#";$myurl6="#";$myurl7="#";$myurl8="#";$myurl9="#";$myurl10="#";
				 	$CatIdObj = get_category_by_slug($group);		
					$TagIdObj = get_term_by('slug', $group, 'post_tag');
					if (!empty($CatIdObj)){
						if($cnt_button==1){$myurl1 = get_category_link( $CatIdObj);}
						if($cnt_button==2){$myurl2 = get_category_link( $CatIdObj);}
						if($cnt_button==3){$myurl3 = get_category_link( $CatIdObj);}
						if($cnt_button==4){$myurl4 = get_category_link( $CatIdObj);}
						if($cnt_button==5){$myurl5 = get_category_link( $CatIdObj);}
						if($cnt_button==6){$myurl6 = get_category_link( $CatIdObj);}
						if($cnt_button==7){$myurl7 = get_category_link( $CatIdObj);}
						if($cnt_button==8){$myurl8 = get_category_link( $CatIdObj);}
						if($cnt_button==9){$myurl9 = get_category_link( $CatIdObj);}
						if($cnt_button==10){$myurl10 = get_category_link( $CatIdObj);}					
						}
					elseif (!empty($TagIdObj)){
						if($cnt_button==1){$myurl1 = get_term_link( $TagIdObj);}
						if($cnt_button==2){$myurl2 = get_term_link( $TagIdObj);}
						if($cnt_button==3){$myurl3 = get_term_link( $TagIdObj);}
						if($cnt_button==4){$myurl4 = get_term_link( $TagIdObj);}
						if($cnt_button==5){$myurl5 = get_term_link( $TagIdObj);}
						if($cnt_button==6){$myurl6 = get_term_link( $TagIdObj);}
						if($cnt_button==7){$myurl7 = get_term_link( $TagIdObj);}
						if($cnt_button==8){$myurl8 = get_term_link( $TagIdObj);}
						if($cnt_button==9){$myurl9 = get_term_link( $TagIdObj);}
						if($cnt_button==10){$myurl10 = get_term_link( $TagIdObj);}
						}					
					if (!empty($CatIdObj)){$wud_cat_or_term_name = $CatIdObj->name;}
					if (!empty($TagIdObj)){$wud_cat_or_term_name = $TagIdObj->name;}
					
					$hb_result .= "<input type='hidden' name='wud_group_number' id='wud_group_number_".$count_cats_tags.$cnt_button."' value='".$count_cats_tags.$cnt_button."'/>";
					$hb_result .= "<input type='hidden' name='wud_group_more' id='wud_group_more_".$count_cats_tags.$cnt_button."' value='".implode(" ",$groups)."'/>";
					$hb_result .= "<input type='hidden' name='grid_wud_widget' id='grid_wud_widget_".$count_cats_tags.$cnt_button."' value='".$grid_wud_widget."'/>";
					$hb_result .= "<input type='hidden' name='tiles' id='tiles_".$count_cats_tags.$cnt_button."' value='".$tiles."'/>";
					$hb_result .= "<input type='hidden' name='background' id='background_".$count_cats_tags.$cnt_button."' value='".$background."'/>";
					$hb_result .= "<input type='hidden' name='widgetfront' id='widgetfront_".$count_cats_tags.$cnt_button."' value='".$widgetfront."'/>";
					$hb_result .= "<input type='hidden' name='grid_wud_shape' id='grid_wud_shape".$count_cats_tags.$cnt_button."' value='".$grid_wud_shape."'/>";
					$hb_result .= "<input type='hidden' name='dark_excerpt' id='dark_excerpt".$count_cats_tags.$cnt_button."' value='".$dark_excerpt."'/>";
					$hb_result .= "<input type='hidden' name='args1' id='args1".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args1))."'/>";
					$hb_result .= "<input type='hidden' name='args2' id='args2".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args2))."'/>";
					$hb_result .= "<input type='hidden' name='args3' id='args3".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args3))."'/>";
					$hb_result .= "<input type='hidden' name='args4' id='args4".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args4))."'/>";
					$hb_result .= "<input type='hidden' name='args5' id='args5".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args5))."'/>";
					$hb_result .= "<input type='hidden' name='args6' id='args6".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args6))."'/>";
					$hb_result .= "<input type='hidden' name='args7' id='args7".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args7))."'/>";
					$hb_result .= "<input type='hidden' name='args8' id='args8".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args8))."'/>";
					$hb_result .= "<input type='hidden' name='args9' id='args9".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args9))."'/>";
					$hb_result .= "<input type='hidden' name='args10' id='args10".$count_cats_tags.$cnt_button."' value='".base64_encode(serialize($args10))."'/>";					
					$hb_result .= "<input type='hidden' name='gridurl1' id='gridurl1".$count_cats_tags.$cnt_button."' value='".$myurl1."'/>";
					$hb_result .= "<input type='hidden' name='gridurl2' id='gridurl2".$count_cats_tags.$cnt_button."' value='".$myurl2."'/>";
					$hb_result .= "<input type='hidden' name='gridurl3' id='gridurl3".$count_cats_tags.$cnt_button."' value='".$myurl3."'/>";
					$hb_result .= "<input type='hidden' name='gridurl4' id='gridurl4".$count_cats_tags.$cnt_button."' value='".$myurl4."'/>";
					$hb_result .= "<input type='hidden' name='gridurl5' id='gridurl5".$count_cats_tags.$cnt_button."' value='".$myurl5."'/>";
					$hb_result .= "<input type='hidden' name='gridurl6' id='gridurl6".$count_cats_tags.$cnt_button."' value='".$myurl6."'/>";
					$hb_result .= "<input type='hidden' name='gridurl7' id='gridurl7".$count_cats_tags.$cnt_button."' value='".$myurl7."'/>";
					$hb_result .= "<input type='hidden' name='gridurl8' id='gridurl8".$count_cats_tags.$cnt_button."' value='".$myurl8."'/>";
					$hb_result .= "<input type='hidden' name='gridurl9' id='gridurl9".$count_cats_tags.$cnt_button."' value='".$myurl9."'/>";
					$hb_result .= "<input type='hidden' name='gridurl10' id='gridurl10".$count_cats_tags.$cnt_button."' value='".$myurl10."'/>";					
					$hb_result .= "<input type='hidden' name='grid_wud_button' id='grid_wud_button".$count_cats_tags.$cnt_button."' value='".$grid_wud_button."'/>";
					$hb_result .= "<input type='hidden' name='grid_wud_or_popup' id='grid_wud_or_popup".$count_cats_tags.$cnt_button."'  value='".$grid_wud_or_popup."'/>";
					$hb_result .= "<input type='hidden' name='grid_wud_or_woo' id='grid_wud_or_woo".$count_cats_tags.$cnt_button."'  value='".$grid_wud_or_woo."'/>";
				//Hide first group button
			   if ($hide_group_button==1 && $cnt_button==1){}
			   //Collect group buttons
			   else{$hb_result .= "<button ClickResultGroup='".$count_cats_tags.$cnt_button."' class='grid-wud-h2' id='group_wud_button' style='border-radius:".$gwfuncs['grid_wud_round_button']."px; padding-left: 4px !important; padding-right: 4px !important; line-height:".$lineheight."vw; font-size:1vw; background-color:".$gwfuncs['grid_wud_cat_bcolor'].";' type='submit'>".$wud_cat_or_term_name."</button>";}

				}
					$hb_result .= "</form><div class='clear'></div>";
					
			return $hb_result;
}

// Collect the button data
function collectbutton(){
	global $gwfuncs, $wud_cat_or_term_url, $pods_is_used, $wp_cat, $totalgrids, $wud_quantity, $count_cats_tags, $Xpost, $Tpost, $stickyleft, $grid_wud_or_woo;
	global $grid_wud_sticky, $wud_latest_post, $order_by, $order_sort, $grid_ids, $posttype, $tax_name, $pods_cat, $tag_id, $cat_id, $is_numbers, $grid_wud_gray;
	global $grid_wud_shape, $tiles, $postids, $background, $grids, $grid_wud_button, $slugs, $button_act, $totalgroups, $cat_found, $term_found, $dark_excerpt;
	global $grid_wud_or_popup;
	$showres = NULL;
	
	if($Xpost != $Tpost){
		//START FORM (value transfered to JQuery --> grid-wud-xtra)
				$showres .= "<form method='post' id='grid_wud_form'>";
				// # extra post by button
				$showres .= "<input type='hidden' name='grid_wud_set_more_grid' id='grid_wud_set_more_grid_".$count_cats_tags."' value='".$gwfuncs['grid_wud_set_more_grid']."'/>";
				$showres .= "<input type='hidden' name='tpost' id='tpost".$count_cats_tags."' value='".$Tpost."'/>";
				$showres .= "<input type='hidden' name='stickyleft' id='stickyleft".$count_cats_tags."'  value='".serialize($stickyleft)."'/>";
				$showres .= "<input type='hidden' name='sticky' id='sticky".$count_cats_tags."' value='".$grid_wud_sticky."'/>";
				$showres .= "<input type='hidden' name='dark_excerpt' id='dark_excerpt".$count_cats_tags."' value='".$dark_excerpt."'/>";
				// # post if page called
				$showres .= "<input type='hidden' name='grid_wud_set_max_grid' id='grid_wud_set_max_grid_".$count_cats_tags."'  value='".$wud_quantity."'/>";
				$showres .= "<input type='hidden' name='grid_wud_grid_nr' id='grid_wud_grid_nr_".$count_cats_tags."'  value='".$totalgrids."'/>";
				$showres .= "<input type='hidden' name='grid_wud_tags' id='grid_wud_tags_".$count_cats_tags."'  value='".$tag_id."'/>";
				$showres .= "<input type='hidden' name='grid_wud_cats' id='grid_wud_cats_".$count_cats_tags."'  value='".$cat_id."'/>";
				
				$showres .= "<input type='hidden' name='cat_found' id='cat_found".$count_cats_tags."'  value='".$cat_found."'/>";
				$showres .= "<input type='hidden' name='tag_found' id='tag_found".$count_cats_tags."'  value='".$term_found."'/>";
				
				$showres .= "<input type='hidden' name='grid_wud_shape' id='grid_wud_shape_".$count_cats_tags."'  value='".$grid_wud_shape."'/>";
				$showres .= "<input type='hidden' name='grid_wud_latest' id='grid_wud_latest_".$count_cats_tags."'  value='".$wud_latest_post."'/>";
				$showres .= "<input type='hidden' name='tiles' id='tiles".$count_cats_tags."'  value='".$tiles."'/>";
				$showres .= "<input type='hidden' name='grid_wud_hide_button' id='grid_wud_hide_button".$count_cats_tags."'  value='".$gwfuncs['grid_wud_hide_button']."'/>";
				// post id's to deny
				$showres .= "<input type='hidden' name='grid_wud_ids' id='grid_wud_ids_".$count_cats_tags."'  value='".serialize($grid_ids)."'/>";
				$showres .= "<input type='hidden' name='background' id='background".$count_cats_tags."'  value='".$background."'/>";
				$backimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/gray-out.png';
				$showres .= "<input type='hidden' name='backimg' id='backimg".$count_cats_tags."'  value='".$backimg."'/>";
				
				$showres .= "<input type='hidden' name='grid_wud_gray' id='grid_wud_gray".$count_cats_tags."'  value='".$grid_wud_gray."'/>";
				
				$showres .= "<input type='hidden' name='grid_wud_or_woo' id='grid_wud_or_woo".$count_cats_tags."'  value='".$grid_wud_or_woo."'/>";
				
				$showres .= "<input type='hidden' name='backcol' id='backcol".$count_cats_tags."'  value='".$gwfuncs['grid_wud_but_bcolor']."'/>";
				
				if($grids ==2){
					$showres .= "<input type='hidden' name='grid_wud_shadow' id='grid_wud_shadow".$count_cats_tags."'  value='1'/>";
				}
				else{
					$showres .= "<input type='hidden' name='grid_wud_shadow' id='grid_wud_shadow".$count_cats_tags."'  value='0/>";
				}
				$showres .= "<input type='hidden' name='count_cats_tags' id='count_cats_tags'  value='".$count_cats_tags."'/>";
				$showres .= "<input type='hidden' name='posttype' id='posttype".$count_cats_tags."'  value='".$posttype."'/>";
				//Pods
				$showres .= "<input type='hidden' name='tax_name' id='tax_name".$count_cats_tags."'  value='".$tax_name."'/>";
				if(!empty($pods_cat)){$showres .= "<input type='hidden' name='pods_cat' id='pods_cat".$count_cats_tags."'  value='".implode(" ",$pods_cat)."'/>";}
				else{$showres .= "<input type='hidden' name='pods_cat' id='pods_cat".$count_cats_tags."'  value='".implode(" ",$wp_cat)."'/>";}
				$showres .= "<input type='hidden' name='pods_is_used' id='pods_is_used".$count_cats_tags."'  value='".$pods_is_used."'/>";
				$showres .= "<input type='hidden' name='is_numbers' id='is_numbers".$count_cats_tags."'  value='".$is_numbers."'/>";
				$showres .= "<input type='hidden' name='postids' id='postids".$count_cats_tags."'  value='".implode(" ",$postids)."'/>";
				
				$showres .= "<input type='hidden' name='order_by' id='order_by".$count_cats_tags."'  value='".$order_by."'/>";
				$showres .= "<input type='hidden' name='order_sort' id='order_sort".$count_cats_tags."'  value='".$order_sort."'/>";
				$showres .= "<input type='hidden' name='grid_wud_or_popup' id='grid_wud_or_popup".$count_cats_tags."'  value='".$grid_wud_or_popup."'/>";
//				
				$buttonheight=$gwfuncs['grid_wud_but_font_size']+1;
				
					//setting = grids, force = button:0 or button:2
					if($gwfuncs['grid_wud_show_arch_grid'] == 0){
						 if($grid_wud_button == 0){ $button_act=0; }
						 elseif($grid_wud_button == 2){ $button_act=2; }
						 else{ $button_act=0; }
					}
					
					//setting = archives, force = button:0 or button:2
					if($gwfuncs['grid_wud_show_arch_grid'] == 1){
						 if($grid_wud_button == 0){ $button_act=0; }
						 elseif($grid_wud_button == 2){ $button_act=2; }
						 else{ $button_act=2; }
					}					
					
			//Show GRIDS
				  if($button_act==0 && $totalgroups==0){
					//Show text or + sign
					if($gwfuncs['grid_wud_show_grid_button']=='')
						{$showres .= "</div><div class='grid-wud-bottom'><button ClickResult='".$count_cats_tags."' id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'> + </button></div>";}
					else
						{$showres .= "</div><div class='grid-wud-bottom'><button ClickResult='".$count_cats_tags."' id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'>".$gwfuncs['grid_wud_show_grid_button']."</button></div>";}
				  }
				$showres .= "</form>";
		//END FORM
	
				  
				  //SHOW ARCHIVES
				  if($button_act==2 && $totalgroups==0){
					//Show text or + sign
					$backimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/gray-out.png';
					if($gwfuncs['grid_wud_show_grid_button']=='' && ($slugs !='wud-latest' || $slugs !='woocommerce')){
						if($wud_cat_or_term_url != "#_"){
							$showres .= "</div><div class='grid-wud-bottom'><a href='".$wud_cat_or_term_url."' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'> + </button></a></div>";
						}
						else{
							$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:#9e9e9e; background-image: url(\"".$backimg."\");' type='submit'> + </button></div>";
						}
							}
					elseif($gwfuncs['grid_wud_show_grid_button']!='' && ($slugs !='wud-latest' || $slugs !='woocommerce')){
						if($wud_cat_or_term_url != "#_"){
							$showres .= "</div><div class='grid-wud-bottom'><a href='".$wud_cat_or_term_url."' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'>".$gwfuncs['grid_wud_show_grid_button']."</button></a></div>";
						}
						else{
							$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:#9e9e9e; background-image: url(\"".$backimg."\");' type='submit'>".$gwfuncs['grid_wud_show_grid_button']."</button></div>";
						}
						}
					//If LATEST POST !!!

					elseif($gwfuncs['grid_wud_show_grid_button']=='' && ($slugs !='wud-latest' || $slugs !='woocommerce'))
						{$showres .= "</div><div class='grid-wud-bottom'><a href='".site_url()."?post_type=post' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'> + </button></a></div>";}
					
					elseif($gwfuncs['grid_wud_show_grid_button']!='' && ($slugs !='wud-latest' || $slugs !='woocommerce'))
						{$showres .= "</div><div class='grid-wud-bottom'><a href='".site_url()."?post_type=post' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'>".$gwfuncs['grid_wud_show_grid_button']."</button></a></div>";}
						
				  }
			}
			// if $posts != $Tpost
				else{
				  $backimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/gray-out.png';
				  $buttonheight=$gwfuncs['grid_wud_but_font_size']+1;
				  //Remove button
				  if($gwfuncs['grid_wud_hide_button']==1 && $totalgroups==0){
					$showres .= "</div><div class='grid-wud-bottom'></div>";  
				  }
				  //Do not change button
				  elseif($gwfuncs['grid_wud_hide_button']==0 && $totalgroups==0){
					if($gwfuncs['grid_wud_show_grid_button']=='')
						{$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='cursor: default; font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' > + </button></div>";}
					else
						{$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='cursor: default; font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' >".$gwfuncs['grid_wud_show_grid_button']."</button></div>";}
				  }	
				  //Gray overlay button
				 elseif($gwfuncs['grid_wud_hide_button']==2 && $totalgroups==0){
					if($gwfuncs['grid_wud_show_grid_button']=='')
						{$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='cursor: default; font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw; line-height:".$buttonheight."vw;  background-color:".$gwfuncs['grid_wud_but_bcolor']."; color: #9e9e9e; background-image: url(\"".$backimg."\");' > + </button></div>";}
					else
						{$showres .= "</div><div class='grid-wud-bottom'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_cats_tags."' style='cursor: default; font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color: #9e9e9e; background-image: url(\"".$backimg."\");' >".$gwfuncs['grid_wud_show_grid_button']."</button></div>";}
				  }
				}
		
			//Show GRIDS by groups
				if(($button_act==0 || $button_act==2) && $totalgroups > 0){
						$readmore=collectreadmore($count_cats_tags, $wud_cat_or_term_url);
						$showres .=  $readmore;
				}
				
			return $showres;
}

//Collect Read more button
function collectreadmore($count_tag, $gridurl){
			global $gwfuncs;
			$resultmore = NULL;
			$buttonheight=$gwfuncs['grid_wud_but_font_size']+1;
			  	if($gwfuncs['grid_wud_show_grid_button']=='')
				  {$resultmore .= "</div><div class='grid-wud-bottom'><a id='group_button_".$count_tag."' href='".$gridurl."' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_tag."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'> + </button></a></div>";}
				else
				  {$resultmore .= "</div><div class='grid-wud-bottom'><a id='group_button_".$count_tag."' href='".$gridurl."' style='text-decoration: none;'><button id='grid_wud_button' class='grid-wud-h3-txt ".$count_tag."' style='font-family:".$gwfuncs['grid_wud_font_button']." !important;border-radius:".$gwfuncs['grid_wud_round_button']."px; font-size:".$gwfuncs['grid_wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$gwfuncs['grid_wud_but_bcolor']."; color:".$gwfuncs['grid_wud_but_fcolor'].";' type='submit'>".$gwfuncs['grid_wud_show_grid_button']."</button></a></div>";}			
				
			  
			  return $resultmore;
}

//Collect the images
function collectimages($post){	
		global $gwfuncs, $nofeatimg;
			$wud_feat_image=NULL;
			//Popup Image (full picture)
			$wud_popup_image=NULL;
			//Search the used image size
			$thumbs =get_image_sizes();
			
				// Parameter set featured image as primary
				if(empty($wud_feat_image) && $gwfuncs['grid_wud_set_featured_img']=='1'){
					foreach($thumbs as $thumbid=>$thumbname) {  
					 if($thumbname['id']==$gwfuncs['grid_wud_thumb_img']){
						 //Disable 'category featured images extended'
						 if(class_exists('category_featured_images_extended') && $nofeatimg==1){}
						 //Read teh featured image
						 else{
							 $image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$thumbid);
							 $popup_thumb=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false );
							 }
					 }
					} 	
				//START Nelio External Featured Image
					if ( function_exists( 'uses_nelioefi' ) && 	uses_nelioefi( $post->ID )) { 							
					$image_thumb = array( nelioefi_get_thumbnail_src( $post->ID ) );
					}					
				//END Nelio External Featured Image						
					if (!empty($image_thumb)){
						$wud_feat_image=$image_thumb[0];
						}	
					if (!empty($popup_thumb)){
						$wud_popup_image=$popup_thumb[0];
						}						
				}
				
				// If no featured image, try first post image
				if (empty($wud_feat_image)){
					$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
					$wud_feat_img = $matches [1];
						// If images found in post, take the first one
						if (!empty($wud_feat_img)){

								$image_url = $wud_feat_img[0]; 
							
								$image_id = wud_get_image_id($image_url);
									
								foreach($thumbs as $thumbid=>$thumbname) { 							
								 if($thumbname['id']==$gwfuncs['grid_wud_thumb_img']){
									$image_thumb = wp_get_attachment_image_src($image_id, $thumbid); 
									$popup_thumb=wp_get_attachment_image_src( $image_id, 'full', false );
								 }
								} 								
								if($image_id==0){$image_thumb = $wud_feat_img;}	
								$wud_feat_image = $image_thumb[0];
								
					if (empty($wud_feat_img)){
						$wud_feat_image = $wud_feat_img[0];
						}								
					if (!empty($popup_thumb)){
						$wud_popup_image=$popup_thumb[0];
						}									
							
							} 
						// If no images, place empty one
						else{					
							//If there are GALLERY images
							$gallery = get_post_gallery( $post, false );
							$gids = explode( ",", $gallery['ids'] );
									 
							foreach( $gids as $gid ) {
								//if found, just pick the first one only
								if($gid){
	
								foreach($thumbs as $thumbid=>$thumbname) {  
								 if($thumbname['id']==$gwfuncs['grid_wud_thumb_img']){
									$image_thumb = wp_get_attachment_image_src($gid, $thumbid); 
									$popup_thumb=wp_get_attachment_image_src( $gid, 'full', false );
								 }
								} 																
									$wud_feat_image = $image_thumb[0];										
								break;
								}
							}	
							if (!empty($popup_thumb)){
								$wud_popup_image=$popup_thumb[0];
								}	
						
							//Try to get the Youtube picture
							if (empty($wud_feat_image)){
							$output=preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $post->post_content, $matches);
								if($output){
									$wud_feat_image= "https://img.youtube.com/vi/".$matches [1]."/0.jpg";
									}	
							}
							
							//Try to get the Vimeo picture
							if (empty($wud_feat_image)){
								$output=preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $post->post_content, $id);
									if($output){
									$xml_data=simplexml_load_file('https://vimeo.com/api/oembed.xml?url=https://vimeo.com/'.$id[5]);																
									$wud_feat_image = $xml_data->thumbnail_url;									
									}
							}																			
							
						}
						
						// If no image found, try featured or place default one
						if(empty($wud_feat_image)){
							foreach($thumbs as $thumbid=>$thumbname) {  
							 if($thumbname['id']==$gwfuncs['grid_wud_thumb_img']){
								$image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$thumbid); 
								$popup_thumb=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false );
							 }
							} 					
							if (!empty($image_thumb)){
								$wud_feat_image=$image_thumb[0];								
								}
							if (!empty($popup_thumb)){
								$wud_popup_image=$popup_thumb[0];
								}									
						}
						
				//Still empty ... no picture is found		
				if (empty($wud_feat_image)){								
					$wud_feat_image= $gwfuncs['grid_wud_def_img'];
					$wud_popup_image= $gwfuncs['grid_wud_def_img'];
					}
				}	
				    $out['feat_img'] = $wud_feat_image;
					$out['popup_img'] = $wud_popup_image;
					return $out;
}

// Collect the grids data
function collectgrids($posts){
	global $gwfuncs, $grid_wud_or_popup, $widgetfront, $grid_wud_or_woo, $grid_wud_widget, $posttype, $wud_grid_nr, $grid_ids, $grid_wud_shape, $tiles, $background, $grids, $thumbs, $wud_cat_or_term_name, $dark_excerpt, $woocommerce, $grid_wud_gray;
	$wud_grid_nr = 1;
	$showres = NULL;
	$bgcs="#fff";
	$wud_excerpt = "";
	$wud_post_title  = NULL;
	if($grid_wud_shape == 4){$circle="gridis='circle'";} else{$circle="";}
			  foreach ($posts as $post) { 

				$posttype = get_post_type( $post->ID );
				$grid_ids[] = $post->ID; 
				$wud_feat_image=NULL; // Make the variable empty
				// CSS variable (size, a.o.)
				if ($wud_grid_nr>20){$wud_grid_nr=1;}
				
				if($gwfuncs['grid_wud_show_grid_button']==""){$readmorewud = " + ";} else{$readmorewud = $gwfuncs['grid_wud_show_grid_button'];}
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
				// WP excerpt
				if($gwfuncs['grid_wud_show_excerpt']=='1' || $gwfuncs['grid_wud_show_excerpt']=='2' || $gwfuncs['grid_wud_show_excerpt']=='3' || $gwfuncs['grid_wud_show_excerpt']=='4'){
					//If the real WP excerpt exist (fil in with your own content)
					if(!empty($post->post_excerpt)){$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_excerpt, $gwfuncs['grid_wud_excerpt_words'] ) );}
					//Else we make our own excerpt from the content
					else{$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_content, $gwfuncs['grid_wud_excerpt_words'] ) );}
						//Remove http and https URLS from the excerpt
						$pattern = '~http(s)?://[^\s]*~i';
						$wud_excerpt = preg_replace($pattern, '', $wud_excerpt);
						
				}
					//wud_excerpt_popup for java script popup
					if(!empty($post->post_excerpt)){$wud_excerpt_popup = strip_shortcodes ( wp_trim_words ( $post->post_excerpt, $gwfuncs['grid_wud_excerpt_words'] ) );}
					else{$wud_excerpt_popup = strip_shortcodes ( wp_trim_words ( $post->post_content, $gwfuncs['grid_wud_excerpt_words'] ) );}
						$pattern = '~http(s)?://[^\s]*~i';
						$wud_excerpt_popup = $woobutton.preg_replace($pattern, '', $wud_excerpt_popup);	
			
			
    //Collect the image(s)
	$popup_array = collectimages($post);	
	$wud_feat_image = $popup_array['feat_img'];
	
	if($popup_array['popup_img']){$wud_popup_image = $popup_array['popup_img'];}
	else{$wud_popup_image = $popup_array['feat_img'];}
	
	//PRELOAD IMG (loads every image before it shows as background in the grid/tile)
	echo '<script type="text/javascript">var wud_image = new Image(); wud_image.src =\''.$wud_feat_image.'\';</script>';	
	
	//URL START	
				if($gwfuncs['grid_wud_rev_back']==1){$background_switch="grid-wud-primary-color";}
				else{$background_switch="grid-wud-standard-color";}
				if($dark_excerpt==1){$background_switch="grid-wud-primary-color";}
				if($dark_excerpt==0){$background_switch="grid-wud-standard-color";}	
				if($posttype=="product"){$background_switch .= " wooexcerpt";}
				
         if($gwfuncs['grid_wud_nourl']==0 && post_type_exists( $posttype )){ 
			if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$showres .= "<a href='".$wud_feat_image."' style='text-decoration: none;' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_post_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' >";
			}
			else{
				$showres .= "<a href='".@get_post_permalink($post->ID)."' style='text-decoration: none;' title='' alt='' class='".$background_switch."'>"; 
			}
		 }
         if($gwfuncs['grid_wud_nourl']==2 && post_type_exists( $posttype )){
			 if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$showres .= "<a href='".$wud_feat_image."' style='text-decoration: none;' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' >";			 
			 }
			 else{
				$showres .= "<a href='".@get_permalink($post->ID)."' style='text-decoration: none;' title='' alt='' class='".$background_switch."'>"; 
			 }
		 }

			//-> Wrapper-start
			
			// *** CIRCLE ***
			if($grid_wud_shape == 4  && $background== 0){
				if ($grid_wud_widget==0 ||  $widgetfront==1){
										
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
					
					//GRIDS
					if($grids==0 ){
						$showres .= "<div ".$circle." class='grid-wud-wrapper' id='grid-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 
					}
					//TILES
					else{
						//shadow
						if($grids==2){
						$showres .= "<div ".$circle."  class='grid-wud-wrapper grid-wud-wrapper-box' id='tile-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 
						}
						//no shadow
						else{
						$showres .= "<div ".$circle."  class='grid-wud-wrapper' id='tile-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 
						}						
					}					
				}
				//WIDGET
				else{
					$showres .= "<div ".$circle."  class='grid-wud-wrapper' id='grid-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; width: 100% !important;	height: 0; padding-bottom: 100% !important;	margin: 0.5%; border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; ' >"; 
				}
			}
			
			// *** SQUARE ***
			else{
				if ($grid_wud_widget==0 ||  $widgetfront==1){
					
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

					//GRIDS
					if($grids==0 ){
						$showres .= "<div ".$circle."  class='grid-wud-wrapper' id='grid-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -moz-border-radius:".$gwfuncs['grid_wud_round_img']."px !important;' >"; 				
					}
					//TILES
					else{
						//shadow
						if($grids==2){
						$showres .= "<div ".$circle."  class='grid-wud-wrapper grid-wud-wrapper-box' id='tile-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -moz-border-radius:".$gwfuncs['grid_wud_round_img']."px !important;' >"; 	
						}
						//no shadow
						else{
						$showres .= "<div ".$circle."  class='grid-wud-wrapper' id='tile-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -moz-border-radius:".$gwfuncs['grid_wud_round_img']."px !important;' >"; 	
						}						
					}					
				}
				//WIDGETS
				else{
					$showres .= "<div ".$circle."  class='grid-wud-wrapper' id='grid-".$grid_wud_shape."-wud-wrapper-".$wud_grid_nr."' style='z-index: ".$gwfuncs['grid_wud_round_index']."; width: 100% !important;	height: 0; padding-bottom: 100% !important;	margin: 0.5%; border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -webkit-border-radius:".$gwfuncs['grid_wud_round_img']."px !important; -moz-border-radius:".$gwfuncs['grid_wud_round_img']."px !important;' >"; 
				}
			}	
			
			//-> Image-start & end
				if($grid_wud_shape == 4  && $background== 0){
						$showres .= "<div class='grid-wud-image ".$grid_wud_gray."' style='background-image:url(".$wud_feat_image."); border-radius: 50% !important;-webkit-border-radius: 50% !important;	-moz-border-radius: 50% !important; '></div>";
				}
				else{
					if($background== 0 ){	
						$showres .= "<div class='grid-wud-image ".$grid_wud_gray."' style='background-image:url(".$wud_feat_image.");' ></div>";
					}
				}
			
						
			//Show the category on the grid
					if($gwfuncs['grid_wud_hide_grid_cat']==0 || !$gwfuncs['grid_wud_hide_grid_cat'] || $gwfuncs['grid_wud_hide_grid_cat']==''){}
					else{ //show is value 1
						if ($grid_wud_shape != 4){
								$showres .= "<div id='grid-wud-h4-top' class='grid-wud-h4' style='font-size:16px; height:26px; text-overflow: ellipsis; overflow: hidden;white-space: nowrap; width: 80%; margin-left: 0.5%;'>".$wud_cat_or_term_name."</div>";
						}
					}

	//URL END
	if($gwfuncs['grid_wud_nourl']==0 || $gwfuncs['grid_wud_nourl']==2){
		if(post_type_exists( $posttype )){
			$showres .= "</a>";
		}
      
	}					

	
				//Switch background color
				if($gwfuncs['grid_wud_rev_back']==1){$background_switch="grid-wud-primary-color";}
				else{$background_switch="grid-wud-standard-color";}
				if($dark_excerpt==1){$background_switch="grid-wud-primary-color";}
				if($dark_excerpt==0){$background_switch="grid-wud-standard-color";}	
				if($posttype=="product"){$background_switch .= " wooexcerpt";}
	//URL START 2
    if($gwfuncs['grid_wud_nourl']==0 && post_type_exists( $posttype )){	
			if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$wud_excerpt  = "<a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_post_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>"; 
			 $wud_post_title  = "<a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_post_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'><b>".$post->post_title."</b></a><br>"; 
			}
			else{	
				$wud_excerpt  = "<a href='".@get_post_permalink($post->ID)."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>"; 
			  $wud_post_title = "<a href='".@get_post_permalink($post->ID)."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'><b>".$post->post_title."</b></a><br>"; 
			}
		
	}
	
    if($gwfuncs['grid_wud_nourl']==2 && post_type_exists( $posttype )){	
			if (get_option('grid_wud_popup')=='1' || $grid_wud_or_popup=='1'){
				$wud_excerpt  = "<a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>"; 
			 $wud_post_title  = "<a href='".$wud_feat_image."' wud-lb-gt='".$wud_popup_image."' wud-lb-url='".@get_permalink($post->ID)."' wud-lb-excerpt='".$wud_excerpt_popup."' wud-lb-readmore='".$readmorewud."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'><b>".$post->post_title."</b></a><br>"; 
			}
			else{	
				$wud_excerpt  = "<a href='".@get_permalink($post->ID)."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'>".$wud_excerpt."</a>"; 
			 $wud_post_title  = "<a href='".@get_permalink($post->ID)."' title='' alt='' class='".$background_switch."' style='box-shadow: none !important; background-color: transparent !important; text-decoration: none;'><b>".$post->post_title."</b></a><br>";		
			}			

	}	
	
	if($posttype=="product" && $grid_wud_or_woo != 6 && $grid_wud_or_woo != 7){$wud_post_title  = NULL;}
			//-> The excerpt text

			if ($grid_wud_shape != 4 && $background== 0 ){
				// Show excerpt text
				if($grid_wud_or_woo==1){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;' >".$woobutton."".$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($grid_wud_or_woo==2 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$woobutton.$wud_post_title.$wud_excerpt."</div>";					
				}
				// Show excerpt text and title allways
				elseif ($grid_wud_or_woo==3 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt-2 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$woobutton.$wud_post_title.$wud_excerpt."</div>";						
				}
				// Show excerpt title
				elseif ($grid_wud_or_woo==4 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt-3 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$woobutton.$wud_post_title."</div>";						
				}
				// Show Woocommerce excerpt text and title allways
				elseif ($grid_wud_or_woo==5 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt-5 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$woobutton."<div class='woohide'>".$wud_excerpt."</div></div>";						
				}
				// Hide Woocommerce excerpt text and title
				elseif ($grid_wud_or_woo==6 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt-6 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'><div class='wootitle'>".$wud_post_title."</div>".$woobutton.$wud_excerpt."</div>";						
				}
				elseif ($grid_wud_or_woo==7 ){
					$showres .= "<div id='".$woodisplay."' class='grid-wud-excerpt-6 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$wud_post_title."</div>";						
				}				
			}
			elseif ($grid_wud_shape == 4 && $background== 0 ){
					if($gwfuncs['grid_wud_show_excerpt']==1){
						$showres .= "<div class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important; box-shadow: none !important;'>".$wud_excerpt."</div>";	
					}
					// Show excerpt text and title
					elseif ($gwfuncs['grid_wud_show_excerpt']==2 ){
						$showres .= "<div class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important; box-shadow: none !important;'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";					
					}
					// Show excerpt text and title allways
					elseif ($gwfuncs['grid_wud_show_excerpt']==3 ){
						$showres .= "<div class='grid-wud-excerpt-2 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important; box-shadow: none !important;'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";						
					}
					// Show excerpt title
					elseif ($gwfuncs['grid_wud_show_excerpt']==4 ){
						if($gwfuncs['grid_wud_title_topmid']!=4){
						$showres .= "<div class='grid-wud-excerpt ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important; box-shadow: none !important;'><b>".$post->post_title."</b></div>";						
						}
						else{
						$showres .= "<div class='grid-wud-excerpt-3 ".$background_switch."' style='font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; padding: 3% 2% 3% 4%; border-radius: 10%;-webkit-border-radius: 10%;-moz-border-radius: 10%;margin-left: 10%;width: 80%;bottom: 30%;height: auto;max-height: 30% !important; box-shadow: none !important;'><b>".$post->post_title."</b></div>";							
						}
					}					
				}
			else{
				
				
				// Show excerpt text only
				if($background > 10){
					$hoverimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/empty-txt.png';
					if($background==11){$bgcs=$gwfuncs['grid_wud_bgc1'];}
					elseif($background==12){$bgcs=$gwfuncs['grid_wud_bgc2'];}
					elseif($background==13){$bgcs=$gwfuncs['grid_wud_bgc3'];}
					elseif($background==14){$bgcs=$gwfuncs['grid_wud_bgc4'];}
					elseif($background==15){$bgcs=$gwfuncs['grid_wud_bgc5'];}
					$showres .= "<div onMouseOver=\"this.style.backgroundImage='url(\'".$hoverimg."\')';\" onMouseOut=\"this.style.backgroundImage='none';\" class='grid-wud-excerpt-2-no' style='background-color: ".$bgcs."; font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'>".$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($background < 6){
					$hoverimg= get_option('siteurl').'/wp-content/plugins/grid-wud/images/empty-txt.png';
					if($background==1){$bgcs=$gwfuncs['grid_wud_bgc1'];}
					elseif($background==2){$bgcs=$gwfuncs['grid_wud_bgc2'];}
					elseif($background==3){$bgcs=$gwfuncs['grid_wud_bgc3'];}
					elseif($background==4){$bgcs=$gwfuncs['grid_wud_bgc4'];}
					elseif($background==5){$bgcs=$gwfuncs['grid_wud_bgc5'];}					
					$showres .= "<div onMouseOver=\"this.style.backgroundImage='url(\'".$hoverimg."\')';\" onMouseOut=\"this.style.backgroundImage='none';\" class='grid-wud-excerpt-2-no' style='background-color: ".$bgcs."; font-family:".$gwfuncs['grid_wud_font_excerpt']." !important; font-size:".$gwfuncs['grid_wud_size_excerpt']."px; box-shadow: none !important;'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";					
				}				
			}
		//-> Wrapper-end
					$showres .= "</div>"; 
	
					$wud_grid_nr++; 					
			  }	
			  
			  return $showres;
}
?>