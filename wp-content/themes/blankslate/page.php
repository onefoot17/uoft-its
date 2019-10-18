<?php get_header(); ?>

<main class="content">
    <section class="section section--carousel">
        <section class="section__width">
            <section class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php
                            global $post;

                            $args = array( 
                                'category_name' => 'Carousel'
                            );

                            $postslist = get_posts( $args );

                            foreach ( $postslist as $post ) :
                                setup_postdata( $post );
                        ?>
                                    <li class="glide__slide">
                                        <a class="section__link section__carousel-item section--carousel__link" href="<?php the_permalink(); ?>">
                                            <section>
                                                <h2 class="section__link__title section--carousel__link__title"><?php the_title(); ?></h2>

                                                <p class="section--carousel__link__excerpt"><?php the_excerpt(); ?></p>

                                                <button class="section__button section--carousel__link__button">Learn more<?php get_post_type(); ?></button>
                                            </section>

                                            <?php
                                                if ( has_post_thumbnail() ) {
                                                    echo '<section class="section--carousel__link__image-con">' . wp_get_attachment_image(get_post_thumbnail_id(), 'large', false, array('class' => 'section__link__image section--carousel__link__image') ) . '</section>';
                                                }
                                            ?>
                                        </a>
                                    </li>
                        <?php
                            endforeach;

                            wp_reset_postdata();
                        ?>
                    </ul>
                </div>

                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <?php
                        global $post;

                        $args = array(
                            'category_name' => 'Carousel'
                        );

                        $postslist = get_posts( $args );

                        foreach ( $postslist as $postKey=>$post ) :
                            setup_postdata( $post );

                            echo '<button class="glide__bullet" data-glide-dir="=' . $postKey . '"><i class="fas fa-circle"></i></button>';

                        endforeach;

                        wp_reset_postdata();
                    ?>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-angle-left"></i></button>
                    <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fas fa-angle-right"></i></button>
                </div>
            </section>
        </section>
    </section>

    <section class="section section--alerts">
        <?php
            global $post;

            $args = array(
                'category_name' => 'Alerts',
                'posts_per_page' => 1
            );

            $postslist = get_posts( $args );

            foreach ( $postslist as $post ) :
                setup_postdata( $post ); 
        ?>
                    
                <a class="section__link section--alerts__link" href="<?php the_permalink(); ?>">
                    <h2 class="section__link__title section--alerts__link__title"><?php the_title(); ?></h2>

                    <span class="section--alerts__link__excerpt"><?php the_excerpt(); ?></span>

                    <button class="section__button section--alerts__button">Learn more</button>
                </a>
        <?php
            endforeach;

            wp_reset_postdata();
        ?>
    </section>

    <section class="section section--news">
        <section class="section__width">
            <header class="section__header">
                <h1 class="section--news__heading">Latest News & Announcements</h1>

                <a class="section__button section--news__button" href="">More ITS news</a>
            </header>

            <ul class="section__posts section--news__posts">
                <?php
                    global $post;

                    $args = array(
                        'category_name' => 'News',
                        'posts_per_page' => 4
                    );

                    $postslist = get_posts( $args );

                    foreach ( $postslist as $post ) :
                        setup_postdata( $post ); 
                ?>
                            
                        <li class="section--news__post">
                            <a class="section__link section--news__link" href="<?php the_permalink(); ?>">
                                <?php
                                    if ( has_post_thumbnail() ) {
                                        echo '<section class="section--news__link__image-con">' . wp_get_attachment_image(get_post_thumbnail_id(), 'medium', false, array('class' => 'section__link__image section--news__link__image') ) . '</section>';
                                    }
                                ?>

                                <h2 class="section__link__title section--news__link__title"><?php the_title(); ?></h2>
                            </a>
                        </li>
                <?php
                    endforeach;

                    wp_reset_postdata();
                ?>
            </ul>
        </section>
    </section>

    <section class="section section--follow">
        <section class="section__width">
            <header class="section__header">
                <h1 class="section--follow__heading">Follow Us</h1>

                <a class="section__button section--follow__button" href="https://www.utoronto.ca/social-media-directory/all">ITS social media directory</a>
            </header>

            <ul class="section__posts section--follow__posts">
                <?php
                    global $post;

                    $args = array(
                        'category_name' => 'Follow',
                        'posts_per_page' => 4
                    );

                    $postslist = get_posts( $args );

                    foreach ( $postslist as $post ) :
                        setup_postdata( $post ); 
                ?>
                            
                        <li class="section--follow__post">
                            <a class="section__link section--follow__link" href="<?php the_permalink(); ?>">
                                <button class="section--follow__button section--follow__link__button"><?php the_title(); ?></button>
                            </a>
                        </li>
                <?php
                    endforeach;

                    wp_reset_postdata();
                ?>
            </ul>
        </section>
    </section>

    <section class="section section--highlights">
        <section class="section__width section--highlights__width">
            <ul class="section__posts section--highlights__posts">
                <?php
                    global $post;

                    $args = array(
                        'category_name' => 'Highlights',
                        'posts_per_page' => 4
                    );

                    $postslist = get_posts( $args );

                    foreach ( $postslist as $post ) :
                        setup_postdata( $post ); 
                ?>
                            
                        <li class="section--highlights__post">
                            <a class="section__link section--highlights__link" href="<?php the_permalink(); ?>">
                                <header class="section--highlights__link__top">
                                    <h2 class="section__link__title section--highlights__link__title"><?php the_title(); ?></h2>

                                    <button class="section--highlights__button section--highlights__link__button">Visit Website</button>
                                </header>

                                <section class="section--highlights__link__bottom">
                                    <p class="section--highlights__link__excerpt"><?php the_excerpt(); ?></p>

                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            echo '<section class="section--highlights__link__image-con">' . wp_get_attachment_image(get_post_thumbnail_id(), 'medium', false, array('class' => 'section__link__image section--highlights__link__image') ) . '</section>';
                                        }
                                    ?>
                                </section>
                            </a>
                        </li>
                <?php
                    endforeach;

                    wp_reset_postdata();
                ?>
            </ul>
        </section>
    </section>
</main>

<?php get_footer(); ?>
