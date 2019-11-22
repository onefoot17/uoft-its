<?php 
/*
  Template Name: View News Archive
 */
get_header(); ?>

<div class="row-fluid">
  <div id="quick_nav_container">
    <h2><?php the_title();?> </h2>

    <ul>
      <?php 
      $varpaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      //echo $varpaged;
      query_posts('post_type=news&posts_per_page=12&paged='.$varpaged); 

      if (have_posts()) : while (have_posts()) : the_post();
      
      $newsFeaturedpageImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
      ?>
      
      <?php if($newsFeaturedpageImage[0]){?>
      <li><a href="<?php the_permalink(); ?>">
              <figure><img src="<?php echo $newsFeaturedpageImage[0];?>" alt="" title=""/></figure>
              <span><?php the_title();?>
              <!--<img src="<?php //bloginfo('template_directory'); ?>/images/aero_img.png" class="aero" />-->
              </span>
              </a>
        </li>
      <?php } else { ?>

      <li><a href="<?php the_permalink(); ?>">
          <figure><img src="<?php bloginfo('template_directory');?>/images/default.jpg" alt="" title=""/></figure>
          <span><?php the_title();?>
          
          </span>
          </a>
      </li>
      <?php } ?>

      <?php endwhile; ?>
    </ul>
    
    <div id="nav-above" class="navigation" style="width:100%; float:left;">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'test' ) ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'test' ) ); ?></div>
      </div><!-- #nav-above -->

      <?php else : ?>
        <ul> <li><h2>Not Found</h2></li></ul>
      <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
