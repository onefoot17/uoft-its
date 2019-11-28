<?php get_header(); ?>

<main id="content">
    <section class="section section--category">
        <section class="section__width section--category__width">
            <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>

            <?php if ( have_posts() ) : ?>
                <ul class="section__posts section--category__posts">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li class="section--category__post">
                            <a class="section__link section--category__link" href="<?php the_permalink(); ?>">
                                <?php 
                                    if ( has_post_thumbnail() ) {
                                        echo '<section class="section--category__link__image-con">' . wp_get_attachment_image( get_post_thumbnail_id(), 'medium', false, array( 'class' => 'section__link__image section--category__link__image' ) ) . '</section>';
                                    } else {
                                        echo '<section class="section__image-fallback"><p>' . esc_html( get_bloginfo( 'name' ) ) . '</p></section>';
                                    }
                                ?>

                                <button class="section--category__button section--category__link__button"><?php the_title(); ?></button>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
        
                <?php if ( get_next_posts_link() || get_previous_posts_link() ) {
                    echo '<nav class="section__posts-nav" class="navigation">';
                        if ( get_next_posts_link() ) {
                            echo '<button class="section__posts-nav__next">';
                            
                            next_posts_link( __( '<i class="fas fa-angle-left"></i><span>Older posts</span>' ) );

                            echo '</button>';
                        }

                        if ( get_previous_posts_link() ) {
                            echo '<button class="section__posts-nav__prev">';
                            
                            previous_posts_link( __( '<span>Newer posts</span><i class="fas fa-angle-right"></i>' ) );
                            
                            echo '</button>';
                        }
                    echo '</nav>';
                } ?>
            <?php else : ?>
                <p class="search-not-found-text"><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'its_2019' ); ?></p>

                <section class="search-form-container"><?php get_search_form(); ?></section>
            <?php endif; ?>
        </section>
    </section>
</main>

<?php get_footer(); ?>
