<?php get_header(); ?>

<main class="content legacy">
    <section class="section__width">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <section id="blackboard_container" class="section__width">
                <section id="blackboard_right_container">
                    <h2><?php the_title(); ?></h2>

                    <?php the_content(); ?>
                </section>
            </section>
        <?php endwhile; else : ?>
            <h2>Not Found</h2>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
