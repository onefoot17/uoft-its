<?php get_header(); ?>

<main class="content">
    <section class="section section--featured">
        <section class="section__width glide">
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
                                    <a class="section__link section__carousel-item" href="<?php the_permalink(); ?>">
                                        <h2><?php the_title(); ?></h2>

                                        <p><?php the_excerpt(); ?></p>

                                        <button class="section__button section--featured__button">Learn more</button>
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
                <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-chevron-left"></i></button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fas fa-chevron-right"></i></button>
            </div>
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
                    <h2 class="section--alerts__title"><?php the_title(); ?></h2>

                    <span class="section--alerts__excerpt"><?php the_excerpt(); ?></span>

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
                            
                        <li>
                            <a class="section__link section--news__link" href="<?php the_permalink(); ?>">
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('class' => 'section--news__image') ); ?>

                                <h2 class="section--news__title"><?php the_title(); ?></h2>
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
                            
                        <li>
                            <a class="section__link" href="<?php the_permalink(); ?>">
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('class' => 'section--follow__image') ); ?>

                                <button class="section--follow__button section--follow__posts__button"><?php the_title(); ?></button>
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
                                    <h2 class="section--highlights__posts__title"><?php the_title(); ?></h2>

                                    <button class="section--highlights__button section--highlights__posts__button">Visit Website</button>
                                </header>

                                <section class="section--highlights__link__bottom">
                                    <p class="section--highlights__posts__excerpt"><?php the_excerpt(); ?></p>

                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            echo '<section>' . wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('class' => 'section__image section--highlights__link__image') ) . '</section>';
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
