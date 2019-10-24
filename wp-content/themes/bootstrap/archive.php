<?php get_header(); ?> 



<div class="row-fluid">



    <div class="span8 font-size">

	<?php if (have_posts()) : ?>



	    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>



	    <?php if (is_category()) { ?>

		<h1 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>



	    <?php } elseif (is_tag()) { ?>

		<h1 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>



	    <?php } elseif (is_day()) { ?>

		<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h2>



	    <?php } elseif (is_month()) { ?>

		<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h2>



	    <?php } elseif (is_year()) { ?>

		<h1 class="page-title">Archive for <?php the_time('Y'); ?></h2>



	    <?php } elseif (is_author()) { ?>

		<h1 class="page-title">Author Archive</h2>



	    <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

		<h1 class="page-title">Archives</h2>



	    <?php } ?>



	    <?php while (have_posts()) : the_post(); ?>



		<article <?php post_class('clearfix') ?>>



		    <hr/>



		    <h5><?php echo the_time('F d, Y'); ?></h5>



		    <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>



		    <div class="entry-content">



			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('news_thumb'); ?></a>



			<?php the_excerpt(); ?>



		    </div>



		</article>



	    <?php endwhile; ?>



	    <?php wp_pagenavi(); ?> 



	<?php else : ?>



    	<h2>Nothing found</h2>



	<?php endif; ?>  



    </div> <!-- end span8 -->



    <div class="span4">



	<section id="sidebar">



	    <nav class="box-radius">



		<?php if (is_active_sidebar('standard_menu')) : ?>



		    <?php dynamic_sidebar('standard_menu'); ?>



		<?php endif; ?>



	    </nav>



	    <?php if (is_active_sidebar('standard')) : ?>



		<?php dynamic_sidebar('standard'); ?>



	    <?php endif; ?>



	</aside>



    </div> <!-- end span4 -->



</div> <!-- end row -->



<?php get_footer(); ?>
