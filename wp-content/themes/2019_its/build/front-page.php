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
                                            <section class="section--carousel__link__copy">
                                                <h2 class="section__link__title section--carousel__link__title"><?php the_title(); ?></h2>

                                                <p class="section--carousel__link__excerpt"><?php the_excerpt(); ?></p>

                                                <button class="section__button section--carousel__link__button"><?php the_field('read_more_button'); ?></button>
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

                    <p class="section--alerts__link__excerpt"><?php the_excerpt(); ?></p>

                    <button class="section__button section--alerts__button"><?php the_field('read_more_button'); ?></button>
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

                <a class="section__button section--news__button" href="/category/news/">More ITS News</a>
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

    <section class="section section--highlights">
        <section class="section__width section--highlights__width">
            <header class="section__header section--highlights__header">
                <h1 class="section--highlights__heading">Follow Us</h1>
            </header>

            <section class="section--highlights__postsCon">
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
                                <a class="section__link section--highlights__link" href="<?php the_permalink(); ?>" target="_blank">
                                    <header class="section--highlights__link__top">
                                        <h2 class="section__link__title section--highlights__link__title"><?php the_title(); ?></h2>

                                        <button class="section--highlights__button section--highlights__link__button"><?php the_field('read_more_button'); ?></button>
                                    </header>

                                    <section class="section--highlights__link__bottom">
                                        <?php 
                                            $turn_off_excerpt = get_field('turn_off_excerpt');

                                            if( ! $turn_off_excerpt ) {
                                                echo '<p class="section--highlights__link__excerpt">' . get_the_excerpt();
                                            }
                                            
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

                <section class="section section--highlights__follow">
                    <ul class="section__posts section--highlights__follow__posts">
                        <li class="section--highlights__follow__post"><a class="twitter-timeline" data-height="300" href="https://twitter.com/ITSUofT?ref_src=twsrc%5Etfw">Tweets by ITSUofT</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>

                        <li class="section--highlights__follow__post"><a class="twitter-timeline" data-height="300" href="https://twitter.com/UofTCyberAware?ref_src=twsrc%5Etfw">Tweets by UofTCyberAware</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>

                        <li class="section--highlights__follow__post"><a class="twitter-timeline" data-height="300" href="https://twitter.com/bjuul?ref_src=twsrc%5Etfw">Tweets by bjuul</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>

                        <!-- <?php
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
                        ?> -->
                    </ul>
                </section>
            </section>
        </section>
    </section>
</main>

<?php get_footer(); ?>
