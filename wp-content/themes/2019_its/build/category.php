<?php get_header(); ?>

<main class="content">
    <section class="section section--category">
        <section class="section__width section--category__width">
            <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

            <ul class="section__posts section--category__posts">
                <?php
                    if (have_posts()) : while (have_posts()) : the_post();
                ?>
                        <li class="section--category__post">
                            <a class="section__link section--category__link" href="<?php the_permalink(); ?>">
                                <?php 
                                    if ( has_post_thumbnail() ) {
                                        echo '<section class="section--category__link__image-con">' . wp_get_attachment_image( get_post_thumbnail_id(), 'medium', false, array( 'class' => 'section__link__image section--category__link__image' ) ) . '</section>';
                                    } else {
                                        echo '<section class="section__image-fallback"><p>U of T</p></section>';
                                    }
                                ?>

                                <button class="section--category__button section--category__link__button"><?php the_title(); ?></button>
                            </a>
                        </li>
                <?php endwhile; ?>
            </ul>
        
            <nav class="section__posts-nav" class="navigation">
                <button class="section__posts-nav__prev"><?php next_posts_link( __( '<i class="fas fa-angle-left"></i><span>Older posts</span>', 'test' ) ); ?></button>

                <button class="section__posts-nav__next"><?php previous_posts_link( __( '<span>Newer posts</span><i class="fas fa-angle-right"></i>', 'test' ) ); ?></button>
            </div><!-- #nav-above -->

            <?php else : ?>
                <ul><li><h2>Not Found</h2></li></ul>
            <?php endif; ?>
        </section>
    </section>
</main>

<?php get_footer(); ?>
