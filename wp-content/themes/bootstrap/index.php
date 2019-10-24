<?php get_header(); ?>
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
<div id="quick_nav_container">
    <ul>
		<?php
        $varQueryStr = "SELECT ID,post_title, post_content 
        FROM `wp_posts`, wp_postmeta where post_id=ID and post_type='page' and meta_key='dbt_checkbox' and post_status='publish' ORDER BY `wp_posts`.`ID` DESC LIMIT 0,4";
        $newsFeaturedPage  = $wpdb->get_results($varQueryStr, OBJECT);
        
         foreach($newsFeaturedPage as $post) : 
          setup_postdata($post);
          $newsFeaturedpageImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
		
		  //echo get_post_meta($post->ID, 'parent_id', true);
        ?>				
        <li> 
        <figure>
		<?php if($newsFeaturedpageImage[0]){?><img src="<?php echo $newsFeaturedpageImage[0];?>" alt="" title=""/>
		<?php } else { ?>
        <img src="<?php bloginfo('template_directory');?>/images/default.jpg" alt="" title=""/>
        <?php } ?>
        </figure>
        <span><a href="<?php echo get_page_link($page->ID); ?>"><?php the_title();?></a> </span>
        
       
        	<?php
				$varQueryStr2 = "SELECT ID FROM wp_posts where post_parent='$post->ID' and post_status='publish' ORDER BY `wp_posts`.`ID` DESC ";
				$newsFeaturedSubPage  = $wpdb->get_results($varQueryStr2, OBJECT);
				//print_r($newsFeaturedSubPage);
				if($newsFeaturedSubPage) {
			?><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/aero_img.png" class="aero" /></a>
            
            <ul style="display:none;">
				<?php foreach($newsFeaturedSubPage as  $subpages){ 
                    setup_postdata($subpages);
                ?>
                <li><span><a href="<?php echo get_page_link($subpages->ID); ?>"><?php the_title();?></a></span></li>
                <?php } ?>                  
            </ul>
            
            <?php } ?>
        </li>
        <?php
            endforeach;
        ?>
    </ul>

</div><!--quick_nav_container-->

    <div id="blackboard_container">
    		<div id="blackboard_left_container">

<h3><img src="<?php bloginfo('template_directory'); ?>/images/aero2.jpg" alt="" />Blackboard 8</h3>
<ul class="left_ul">
<li><span>MAIN NAVIGATION LINK<img src="<?php bloginfo('template_directory'); ?>/images/aero3.jpg" alt="" class="aero3" /></span>
    <ul class="sub_list">
    <?php $args = array(
        'sort_order' => 'ASC',
        'sort_column' => '',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 2,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    ); 
    $pages = get_pages($args); 
    
   // print_r($pages);
    foreach($pages as $page){
    ?>
    <li><small><a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a></small></li>
    <?php } ?>

	</ul>
</li>
</ul>




</div><!--blackboard_left_container-->
			<div id="blackboard_right_container">
            		<?php 
					query_posts('page_id=2');
					if (have_posts()) : while (have_posts()) : the_post(); ?>

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
    

<div id="slider_container">
<h3>Latest News for the ACT Unit</h3>
    <div class="carousel">
        <ul style="list-style:none;">
        <?php
		
            $first = true;
            $the_query = new WP_Query('post_type=news');
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post()
        ?>
        
            <li style="width:250px; height:180px; float:left; margin-left:5px;"> <a href="<?php the_permalink(); ?>"><figure><?php the_post_thumbnail('news'); ?></figure>
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
