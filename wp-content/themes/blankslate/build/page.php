<?php get_header(); ?>

<main class="content">
    <section class="section featured">
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
                                    <a class="section__link carousel__item" href="<?php the_permalink(); ?>">
                                        <h2><?php the_title(); ?></h2>

                                        <p><?php the_excerpt(); ?></p>

                                        <button class="section__button carousel__button">Learn more</button>
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

    <section class="section alerts">
        <section class="section__width">
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
                        
                    <a class="section__link alerts__link" href="<?php the_permalink(); ?>">
                        <h2 class="alerts__title"><?php the_title(); ?></h2>

                        <span class="alerts__excerpt"><?php the_excerpt(); ?></span>

                        <button class="section__button alerts__button">Learn more</button>
                    </a>
            <?php
                endforeach;

                wp_reset_postdata();
            ?>
        </section>
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
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('class' => 'section__image') ); ?>

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
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('class' => 'section__image') ); ?>

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
</main>

<?php get_footer(); ?>
