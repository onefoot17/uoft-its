<?php get_header(); ?>

<main class="content legacy">
    <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section id="blackboard_container">
            <section id="blackboard_right_container">
                <h2><?php the_title(); ?></h2>

                <?php the_content(); ?>
            </section>
        </section>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
