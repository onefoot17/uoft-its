<?php
/*
  Template Name: sitemap
 */
?>

<?php get_header(); ?>

<div class="row-fluid">

    <div class="span12 font-size">

	<h2><?php the_title(); ?></h2>

	<hr/>

	<h6>Pages</h6>
	<ul class="clearfix unstyled">
	    <?php wp_list_pages("title_li="); ?>
	</ul>

	<hr/>

	<?php
	$the_query = new WP_Query('post_type=news');
	if ($the_query->have_posts()) :
	    ?>

    	<h6>News Archive</h6>
    	<ul class="clearfix unstyled">
		<?php
		while ($the_query->have_posts()) : $the_query->the_post()
		    ?>
		    <li>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
			(<?php comments_number('0', '1', '%'); ?>)
		    </li>
		    <?php
		endwhile;
	    endif;
	    ?>
	</ul>

	<hr/>

	<h6>Links</h6>
	<ul class="clearfix unstyled">
	    <?php
	    $args = array('title_before' => '<h6>', 'title_after' => '</h6>');
	    wp_list_bookmarks($args);
	    ?> 
	</ul>

	<hr/>

	<h6>Feeds</h6>
	<ul class="clearfix unstyled">
	    <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
	    <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
	</ul>

    </div <!-- end span12 -->
</div> <!-- end row -->

<?php get_footer(); ?>