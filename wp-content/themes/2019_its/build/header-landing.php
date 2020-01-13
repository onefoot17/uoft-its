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
            <a class="header__logos__uoft" href="https://www.utoronto.ca/"
                title="<?php echo get_bloginfo( 'name' ); ?>"><img class="header__logo"
                    src="https://main.its.utoronto.ca/wp-content/uploads/2019/11/U-of-T-logo.svg" /></a>

            <a class="header__logos__its" href="<?php echo get_site_url(); ?>" title="">
                <span class="header__logos__its__top">ITS</span>

                <span class="header__logos__its__bottom">Information Technology Services</span>

            </a>

        </section>
        <div class="container">
            <section class="nav__top">
                <a class="nav__top__button nav__esc" href="mailto:herug2020@utoronto.ca?Subject=HERUG2020">
                    <section class="nav__image-con nav__esc__image-con">
                        <i class="fa fa-envelope"> </i>
                    </section>

                    <section class="nav__esc__text">Email: herug2020@utoronto.ca</section>
                </a>
                <!-- 
                <a class="nav__top__button nav__its-alerts" href="#">
                    <section class="nav__its-alerts__icon twitter">
                        <i class="fa fa-twitter"> </i>
                    </section>

                    <section>Twitter</section>
                </a>     -->

                <!-- <a href="#menu-main" data-href="#menu-main" id="menu-main-toggle" class="menu-toggle menu-open"
                    aria-label="Open main menu" aria-expanded="false" aria-controls="menu-main">
                    <span class="sr-only">Open main menu</span>

                    <span class="fa fa-bars" aria-hidden="true"></span>
                </a>
            </section>
            <section class="nav__bottom">
                <i class="fa fa-bars mobileMenuToggle"></i>
                <section id="menu-main" class="menu-main" aria-hidden="true">
                    <a href="#menu-main-toggle" data-href="#menu-main" id="menu-main-close"
                        class="menu-toggle menu-close" aria-expanded="true" aria-label="Close main menu">
                        <span class="sr-only">Close main menu</span>

                        <span class="fa fa-times" aria-hidden="true"></span>
                    </a> -->

                <?php /*wp_nav_menu( array(
                'theme_location' => 'herug',
                'container' => '',
                'menu_class' => 'nav__menu nav__menu--main',
                'items_wrap' => '<ul class="%2$s" role="menubar" aria-label="Main menu">%3$s</ul>',
                'depth' => 2
            ) ); */?>
                <!-- </section> -->
            </section>
        </div>










    </header>