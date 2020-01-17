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
    <section class="unsupported-browser unsupported-browser-none">You are using an unsupported browser. For best results please use the latest versions of Chrome, Edge, Firefox or Safari.</section>

    <header id="header" class="header">
        <section class="header__logos">
            <a class="header__logos__uoft" href="https://www.utoronto.ca/"
                title="<?php echo get_bloginfo( 'name' ); ?>"><img class="header__logo"
                    src="https://its.utoronto.ca/wp-content/uploads/2019/11/U-of-T-logo.svg" /></a>

            <a class="header__logos__its" href="<?php echo get_site_url(); ?>" title="">
                <span class="header__logos__its__top">ITS</span>

                <span class="header__logos__its__bottom">Information Technology Services</span>
            </a>
        </section>

        <?php get_template_part( 'nav' ); ?>
    </header>
