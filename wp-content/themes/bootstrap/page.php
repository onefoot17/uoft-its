<?php get_header(); 

	//echo count($post->ancestors);

	/*if(count($post->ancestors)==3) {
		$varParent = $post->ancestors[2];
	} else  if(count($post->ancestors)==2) {
		$varParent = $post->ancestors[1];
	} else if($post->post_parent) {
		$varParent = $post->post_parent;
	} else {
		$varParent = $post->ID;		
	}*/

	if(count($post->ancestors)==3) {
		$varParent = $post->ancestors[1];
		
		$varCurrentID = $post->ancestors[0];
		$varDepth2 = 1;
	} elseif(count($post->ancestors)==2) {
		$varParent = $post->ancestors[0];
		$varDepth2 = 1;
		$varCurrentID = $post->ID;
	} else {
		$varParent = $post->ID;		
		$varDepth1 = $post->ID;
	}
?>

<?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

<div class="row-fluid">
	<div class="wrapper">
		<script>
			function featurepage(){
				$(" #quick_nav_container  ul li ul").css({display: "none"}); // Opera Fix
				
				$(" #quick_nav_container li").hover(function(){
						$(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
						},function(){
						$(this).find('ul:first').css({visibility: "hidden"});
						});
				}
				
				$(document).ready(function(){
					featurepage();
				});

			$(function() {
				$(".carousel").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev"
				});
			});
		</script>

		<div id="quick_nav_container" class="featured">
			<?php
				//print_r($post);
				//$args = array('sort_order' => 'ASC', 'hierarchical' => 2,'meta_key' => 'dbt_checkbox', 'child_of' => $varParent, 'parent' => -1,        'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' );

				$args = array('sort_order' => 'ASC','child_of' => $varParent, 'parent' => -1, 'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
					
				$FeaturedPage = get_pages($args); 
				
				global $wpdb;

				foreach($FeaturedPage as $valPage) {
					if (get_depth($valPage->ID)==2) {
						$varQueryStr = "SELECT post_id FROM  $wpdb->postmeta where post_id='$valPage->ID'  && meta_key='dbt_checkbox'";

						$newsFeaturedPage  = $wpdb->get_results($varQueryStr, OBJECT);

						//print_r($newsFeaturedPage);

						if($newsFeaturedPage[0]->post_id && count($post->ancestors) > 0) {
							$varArrdept2Page[] = $valPage->ID;	
						}else {
							$Arrdept2Page[] = $valPage->ID;
						}
					}
						
					//$postset =  setup_postdata($valPage);die;

					//print_r($valPage);

					//echo $valPage->ID;die;
				}

				if($varArrdept2Page) {
					$varArrdept2PageIDS	= implode(",",$varArrdept2Page);
				}

				//echo '<br>===============';
				//print_r($varArrdept2Page); 
				//echo '<br>===============';
				//print_r($Arrdept2Page);
				
				if($varArrdept2PageIDS) {
					$args = array('sort_order' => 'ASC', 'hierarchical' => 2,'meta_key' => 'dbt_checkbox', 'include' => $varArrdept2PageIDS, 'parent' => -1,        'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
					$FeaturedPage = get_pages($args); 
			?>

			<ul>
				<?php
					// $varQueryStr = "SELECT ID,post_title, post_content 
					//FROM `wp_posts`, wp_postmeta where post_id=ID and post_type='page' and meta_key='dbt_checkbox' and post_status='publish' ORDER BY `wp_posts`.`ID` DESC LIMIT 0,4";
					//$newsFeaturedPage  = $wpdb->get_results($varQueryStr, OBJECT);
					$i=1;
					foreach($FeaturedPage as $post) : 
					setup_postdata($post);
					$newsFeaturedpageImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
					$arrFeaturedID[] = $post->ID;
					//echo get_post_meta($post->ID, 'parent_id', true);
					if($i>4) break;
				?>

				<li> 
					<figure>
					<?php if($newsFeaturedpageImage[0]){?><img src="<?php echo $newsFeaturedpageImage[0];?>" alt="" title=""/>
					<?php } else { ?>
					<img src="<?php bloginfo('template_directory');?>/images/default.jpg" alt="" title=""/>
					<?php } ?>
					</figure>

					<span><a href="<?php the_permalink(); ?>"><?php the_title();?></a> </span>
					
					<?php
						$varQueryStr2 = "SELECT ID FROM $wpdb->posts where post_parent='$post->ID' && post_status='publish' ORDER BY `$wpdb->posts`.`ID` DESC ";
						$newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
						//print_r($newsFeaturedSubPage);
						if($newsFeaturedSubPage) {
							
					?>
					
					<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/aero_img.png" class="aero" /></a>
		
					<ul style="display:none;">
						<?php foreach($newsFeaturedSubPage as  $subpages){ 
						$varSubPage = get_post($subpages->ID);
							if($varSubPage->post_title) {
						?>
						<li><span><a href="<?php echo get_page_link($subpages->ID); ?>"><?php echo $varSubPage->post_title;?></a></span></li>
						<?php }
						
						} ?>                  
					</ul>
					
					<?php } ?>
				</li>

				<?php
					$i++;
					endforeach;
				?>
			</ul>
		<?php } ?>

		</div><!--quick_nav_container-->

		<?php
			if($Arrdept2Page) {
		?>
		<div id="blackboard_container">    
			<div id="blackboard_left_container" style="margin:0 30px 0 0;">
				<!-- Below mentioned code for depth 1 or greater -->
				<?php if( count($post->ancestors) > 0 ) { ?>
				<ul class="left_ul">
				<?php
				$varIncludeIDs = implode(",",$Arrdept2Page);
			$args = array('sort_order' => 'ASC',  'include' => $varIncludeIDs, 'parent' => -1,        'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
					$Page = get_pages($args); 
					foreach($Page as $post) {
						setup_postdata($post);
						
						
					$varQueryStr2 = "SELECT ID FROM $wpdb->posts where post_parent='$post->ID' and post_status='publish' ORDER BY `$wpdb->posts`.`ID` DESC ";
					$newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
					
					
			?>
				<li><!--<small>-->
				<?php 
				
				if($newsFeaturedSubPage) { ?>
				<?php if($varDepth2!="" && $varCurrentID==$post->ID){?>
					<img src="<?php bloginfo('template_url'); ?>/images/down.png"  />
				<?php } else { ?>
				<img src="<?php bloginfo('template_url'); ?>/images/triangle.png"  />
				<?php } ?>
				<?php } else { ?>
				<img src="<?php bloginfo('template_url'); ?>/images/square.png" />
				<?php } ?>
				<a href="<?php the_permalink(); ?>#<?php echo $post->ID;?>"><?php the_title(); ?></a><!--</small>--></li>
				<?php if($newsFeaturedSubPage) { ?>
				<ul class="sub_list" 
				<?php if($varDepth2!="" && $varCurrentID==$post->ID){?>
				style="display:block;"
				<?php }else{ ?>
				style="display:none;"
				<?php } ?>
				>
				<?php foreach($newsFeaturedSubPage as  $subpages){ 
							$varSubPage = get_post($subpages->ID);
								if($varSubPage->post_title) {
							?>
					<li><!--<small>--><img src="<?php bloginfo('template_url'); ?>/images/triangle.png" /><a href="<?php echo get_page_link($varSubPage->ID); ?>#<?php echo $subpages->ID;?>"><?php echo $varSubPage->post_title; ?></a><!--</small>--></li>
				<?php } 
				}
				?>  
				</ul> 
				<?php } ?> 
			</li>
			<?php } ?>
			</ul>   
			<?php } else { ?>
			<!-- Below mentioned code for Root pages -->
				<ul class="left_ul">
				<?php
				
				
				
			$args = array('sort_order' => 'ASC',  'child_of' => $varParent,'depth'        => 1, 'parent' => $varParent,        'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish' ); 
					$Page = get_pages($args); 
					foreach($Page as $post) {
						setup_postdata($post);
			?>
			<li><small><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></small></li>
				<?php
					//$varQueryStr2 = "SELECT ID FROM $wpdb->posts where post_parent='$post->ID' and post_status='publish' ORDER BY `$wpdb->posts`.`ID` DESC ";
					//$newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
					
					/*?>if($newsFeaturedSubPage) { 
				?>
				<ul class="sub_list">
				<?php foreach($newsFeaturedSubPage as  $subpages){ 
							$varSubPage = get_post($subpages->ID);
								if($varSubPage->post_title) {
							?>
					<li><small><a href="<?php echo get_page_link($varSubPage->ID); ?>"><?php echo $varSubPage->post_title; ?></a></small></li>
				<?php } 
				}
				?>  
				</ul> 
				<?php }<?php */?>
			</li>
			<?php } ?>
			</ul>

			<?php } ?>
			</div>

			<div id="blackboard_right_container" style="padding-left:0px; margin-left:0px; width:66%; float:left" > 
				<?php 
					wp_reset_query();

					if (have_posts()) : while (have_posts()) : the_post();
				?>

				<!--<article class="post" id="post-<?php the_ID(); ?>">-->

				<a id="<?php echo $post->ID;?>" name="<?php echo $post->ID;?>" ></a>

				<h2><?php the_title(); ?></h2>
				
				<!-- <div class="entry-content">-->
				
					<?php the_content(); ?>
				
				<!-- </div>-->
					
				<!--</article>-->
					
					<?php endwhile; ?>
					
					<?php //wp_pagenavi(); ?> 
					
					<?php else : ?>
						<h2>Not Found</h2>
					<?php endif; ?>
				</div><!--blackboard_left_container-->
		</div>
		<?php  } else { ?>
			<div id="blackboard_container" style="background:url(wp-content/themes/bootstrap/images/fullblakbrd_bg.jpg);">
				<div id="blackboard_right_container" style="margin:0px; width:90%"> 
					<?php 
						wp_reset_query();

						if (have_posts()) : while (have_posts()) : the_post();
					?>

						<!--<article class="post" id="post-<?php the_ID(); ?>">-->
							<h2><?php the_title(); ?></h2>

							<!-- <div class="entry-content">-->
								<?php the_content(); ?>
							<!-- </div>-->
						<!--</article>-->
					<?php endwhile; ?>

						<?php //wp_pagenavi(); ?> 

					<?php else : ?>
						<h2>Not Found</h2>
					<?php endif; ?>
				</div>		
			</div>           
		<?php } ?>

		<div id="slider_container">
		<h3>The Latest News</h3>
			<div class="carousel">
				<ul style="list-style:none;">
				<?php
				
					$first = true;
					$the_query = new WP_Query('post_type=news');
					if ($the_query->have_posts()) :
						while ($the_query->have_posts()) : $the_query->the_post()
				?>
				
					<li style="width:250px; height:180px; float:left; margin-left:5px;"> <a href="<?php the_permalink(); ?>">
					<figure>
						<?php //the_post_thumbnail('news'); 
						$post_thumbnail_id = get_post_thumbnail_id( $post_id );
						$varImage3 = wp_get_attachment_image_src( $post_thumbnail_id, $size, $icon );
						if($varImage3[0]) {
						?>
						<img src="<?php echo $varImage3[0];?>" class="attachment-news wp-post-image" width="250" height="200" />
						<?php } else { ?>
						<img src="<?php bloginfo('template_url'); ?>/images/blank.png" />
						<?php } ?>
					</figure>
				<span><?php the_title();?></span></a></li>
		<?php
				endwhile;
				wp_reset_query();
				endif;
			?>
				</ul>
		</div>
			
		<a href="#" class="next"><img src="<?php bloginfo('template_directory'); ?>/images/prev_img.png" alt="" class="prev_img" /></a>
		<a href="#" class="prev"><img src="<?php bloginfo('template_directory'); ?>/images/next_img.png" alt="" class="next_img" /></a>
		</div>

			<?php 
			/*if($arrFeaturedID) {
				$varIDs = implode(",",$arrFeaturedID);
			}*/
			
			//echo $varIDs;
			/* $args = array(
			'depth'        => 0,
			'show_date'    => '',
			'date_format'  => get_option('date_format'),
			'child_of'     => $varParent,
			'exclude'      => $varIDs,
			'include'      => '',
			'title_li'     => __(''),

			'sort_column'  => 'menu_order, post_title',

			'post_type'    => 'page',
			'post_status'  => 'publish' 
			); 
			
			wp_list_pages( $args );*/

			//print_r($pages);
		// foreach($pages as $page)
			//{
			?>
		<!--  <li><small><a href="<?php //echo get_page_link($page->ID); ?>"><?php //echo $page->post_title; ?></a></small></li>-->
			<?php //} ?>

			

					
			
			
			<!--<div id="slideshow" class="carousel slide clearfix hidden-phone">
			
			<div class="carousel-inner">
				<?php
				
				/* $first = true;
					$the_query = new WP_Query('post_type=slideshow');
					if ($the_query->have_posts()) :
						while ($the_query->have_posts()) : $the_query->the_post()*/
				?>

				<?php
					/*if ($first == true) {
						echo '<div class="item active">';
						$first = false;
					} else {
						echo '<div class="item">';
					}*/
				?>

					<a href="<?php //echo the_permalink(); ?>" title="<?php //the_title(); ?>"><?php //the_post_thumbnail('slideshow'); ?></a>
					<div class="carousel-caption">
						<h3><a href="<?php //echo the_permalink(); ?>" title="<?php //the_title(); ?>"><?php ///the_title(); ?></a></h3>
						<?php //the_excerpt(); ?>            
					</div>
					</div>
					<?php
				//endwhile;
				//wp_reset_query();
				//endif;
			?>
		</div>-->
	</div>
</div>

<?php get_footer(); ?>
