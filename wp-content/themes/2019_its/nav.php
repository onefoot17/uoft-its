<nav class="nav">
    <section class="nav__top">
        <a class="nav__esc" href="https://uthrprod.service-now.com/help">
            <section class="nav__its-alerts__text">Enterprise Service Centre</section>
        </a>

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

    <section class="nav__bottom">
        <section id="menu-main" class="menu-main" aria-hidden="true">
            <a href="#menu-main-toggle" id="menu-main-close" class="menu-toggle menu-close" aria-expanded="true" aria-label="Close main menu">
                <span class="sr-only">Close main menu</span>
    
                <span class="fa fa-times" aria-hidden="true"></span>
            </a>

            <?php wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => '',
                'menu_class' => 'nav__menu nav__menu--main',
                'items_wrap' => '<ul class="%2$s" role="menubar" aria-label="Main menu">%3$s</ul>'
            ) ); ?>
        </section>
    </section>
</nav>
