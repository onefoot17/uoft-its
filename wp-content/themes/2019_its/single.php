<?php get_header(); ?>

<main class="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>

        <?php the_content(); ?>
    <?php endwhile; else : ?>
        <h2>Not Found</h2>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
