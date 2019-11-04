<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />

        <meta name="viewport" content="width=device-width" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&display=swap" rel="stylesheet">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <header id="header" class="header">
            <section class="header__logos">
                <a class="header__logos__uoft" href="<?php echo get_site_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img class="header__logo" src="http://staging.its.utoronto.ca/wp-content/uploads/2019/10/U-of-T-logo.svg" /></a>

                <a class="header__logos__its" href="" title="">
                    <span class="header__logos__its__top">ITS</span>
                    <span class="header__logos__its__bottom">Information Technology Services</span>
                </a>
            </section>

            <?php get_template_part( 'nav' ); ?>
        </header>
