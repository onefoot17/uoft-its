<nav class="nav">
    <section class="nav__top">
        <a class="nav__esc" href="https://uthrprod.service-now.com/help">
            <section class="nav__esc__image-con">
                <img class="nav__esc__image" src="https://main.its.utoronto.ca/wp-content/uploads/2019/11/esc_logo-white.png" title="" />
            </section>

            <section class="nav__esc__text">Enterprise Service Centre</section>
        </a>

        <a class="nav__its-alerts" href="https://www.systemstatus.utoronto.ca/">
            <section class="nav__its-alerts__icon"><i class="fas fa-circle"></i></section>
            
            <section class="nav__its-alerts__text">ITS System Status</section>
        </a>

        <a class="nav__its-alerts" href="http://128.100.131.66/">
            <section class="nav__its-alerts__text">ITS Service Catalogue</section>
        </a>

        <?php wp_nav_menu( array(
            'theme_location' => 'social-links',
            'container' => '',
            'menu_class' => 'nav__menu nav__menu--social'
            ) ); ?>
    </section>

    <section class="nav__bottom">
        <section id="menu-main" class="menu-main" aria-hidden="true">
            <a href="#menu-main-toggle" data-href="#menu-main" id="menu-main-close" class="menu-toggle menu-close" aria-expanded="true" aria-label="Close main menu">
                <span class="sr-only">Close main menu</span>
    
                <span class="fa fa-times" aria-hidden="true"></span>
            </a>

            <?php wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => '',
                'menu_class' => 'nav__menu nav__menu--main',
                'items_wrap' => '<ul class="%2$s" role="menubar" aria-label="Main menu">%3$s</ul>',
                'depth' => 2
            ) ); ?>
        </section>
    </section>
</nav>
