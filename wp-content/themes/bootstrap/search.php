<?php get_header() ?>

<div class="row-fluid">

    <div class="span8 font-size">

	<?php if (have_posts()) : ?>

    	<h2>Search Results</h2>

	    <?php while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		    <h2><?php the_title(); ?></h2>

		    <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

		    <div class="entry">

			<?php the_excerpt(); ?>

		    </div>

		</article>

	    <?php endwhile; ?>

	    <?php wp_pagenavi(); ?>

	<?php else : ?>

    	<h2>No posts found.</h2>

	<?php endif; ?>

    </div> <!-- end span8 -->

    <div class="span4">


    </div> <!-- end span4 -->
</div> <!-- end row -->

<?php get_footer() ?>