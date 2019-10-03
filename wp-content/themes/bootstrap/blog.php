<?php
/*
  Template Name: blog
 */
?>

<?php get_header(); ?>

<div class="row-fluid">

    <div class="span8 font-size">

	<?php
	$the_query = new WP_Query('showposts=10&paged=' . $paged);
	if ($the_query->have_posts()) :
	    ?>

    	<h2>U of T Blog Archive</h2>

	    <?php while ($the_query->have_posts()) : $the_query->the_post() ?>

		<article <?php post_class('clearfix') ?>>

		    <hr/>

		    <h5><?php echo the_time('F d, Y'); ?></h5>

		    <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

		    <div class="entry-content">

			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb_tiny'); ?></a>

			<?php the_excerpt(); ?>

		    </div>

		</article>

	    <?php endwhile; ?>

	    <?php wp_pagenavi(array('query' => $the_query)); ?> 

	<?php else : ?>

    	<h2>Nothing found</h2>

	<?php endif; ?>  

    </div> <!-- end span8 -->

    <div class="span4">

	<section id="sidebar">

	    <?php if (is_active_sidebar('Primary')) : ?>

		<?php dynamic_sidebar('Primary'); ?>

	    <?php endif; ?>

	</aside>

    </div> <!-- end span4 -->
</div> <!-- end row -->   

<?php get_footer(); ?>
