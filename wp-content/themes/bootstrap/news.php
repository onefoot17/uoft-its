<?php
/*
  Template Name: News
 */
  get_header();
?>
<div class="row-fluid">
<div id="quick_nav_container">
<h2><?php the_title();?> </h2>
<ul>
<?php query_posts('post_type=news&posts_per_page=4'); 

if (have_posts()) : while (have_posts()) : the_post();
 $newsFeaturedpageImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
?><?php if($newsFeaturedpageImage[0]){?>
 <li> <a href="<?php the_permalink(); ?>">
        <figure><img src="<?php echo $newsFeaturedpageImage[0];?>" alt="" title=""/></figure>
        <span><?php the_title();?>
       <!-- <img src="<?php //bloginfo('template_directory'); ?>/images/aero_img.png" class="aero" />-->
        </span></a>
  </li>
<?php }else{ ?>
 <li> <a href="<?php the_permalink(); ?>">
        <figure><img src="<?php bloginfo('template_directory');?>/images/default.jpg" alt="" title=""/></figure>
        <span><?php the_title();?>
        </span></a>
  </li>
<?php } ?>
 <?php endwhile; ?>
            
                    <?php //wp_pagenavi(); ?> 
            
                <?php else : ?>
            
                    <li><h2>Not Found</h2></li>
            
                <?php endif; ?>
</ul>
</div>

</div>
    

<?php get_footer(); ?>