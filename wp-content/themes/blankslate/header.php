<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />

        <meta name="viewport" content="width=device-width" />

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <header id="header" class="header">
            <section class="header__logos">
                <a class="header__logos__uoft" href="" title=""><?php echo wp_get_attachment_image( 8695, 'full', false, array('class' => 'header__logo') ); ?></a>

                <a class="header__logos__its" href="" title=""><?php echo wp_get_attachment_image( 8696, 'full', false, array('class' => 'header__logo') ); ?></a>
            </section>

            <nav class="nav">
                <section class="nav__top">
                    <a class="nav__its-alerts" href="http://www.systemstatus.utoronto.ca/">
                        <section class="nav__its-alerts__icon"></section>
                        
                        <section class="nav__its-alerts__text">ITS Alerts</section>
                    </a>

                    <?php wp_nav_menu( array(
                        'theme_location' => 'social-links',
                        'container' => '',
                        'menu_class' => 'nav__menu nav__menu--social'
                    ) ); ?>
                </section>
                
                <?php wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => '',
                    'menu_class' => 'nav__menu nav__bottom'
                ) ); ?>
            </nav>
        </header>
