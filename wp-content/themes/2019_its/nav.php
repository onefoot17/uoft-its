<nav class="nav">
    <section class="nav__top">
        <a class="nav__top__button nav__esc" href="https://uthrprod.service-now.com/help">
            <section class="nav__image-con nav__esc__image-con">
                <img src="https://main.its.utoronto.ca/wp-content/uploads/2019/11/esc_logo-white.png" title="" />
            </section>

            <section class="nav__esc__text">Enterprise Service Centre</section>
        </a>

        <a class="nav__top__button nav__its-alerts" href="https://www.systemstatus.utoronto.ca/">
            <section class="nav__its-alerts__icon"><i class="fas fa-circle"></i></section>

            <section>ITS System Status</section>
        </a>

        <!-- <a class="nav__top__button" href="http://128.100.131.66/">
            <section>ITS Service Catalogue</section>
        </a> -->

        <a class="nav__top__button" href="/herug2020/">
            <section class="nav__image-con nav__herug__image-con">
                <img src="https://main.its.utoronto.ca/wp-content/uploads/2019/12/HERUG-logo.png" title="" />
            </section>

            <section>HERUG 2020</section>
        </a>

        <section class="nav__search-container"><?php get_search_form(); ?></section>

        <a href="#menu-main" data-href="#menu-main" id="menu-main-toggle" class="menu-toggle menu-open"
            aria-label="Open main menu" aria-expanded="false" aria-controls="menu-main">
            <span class="sr-only">Open main menu</span>

            <span class="fa fa-bars" aria-hidden="true"></span>
        </a>
    </section>

    <section class="nav__bottom">
        <section id="menu-main" class="menu-main" aria-hidden="true">
            <a href="#menu-main-toggle" data-href="#menu-main" id="menu-main-close" class="menu-toggle menu-close"
                aria-expanded="true" aria-label="Close main menu">
                <span class="sr-only">Close main menu</span>
            </a>
            <span class="fa fa-times mobile-togger" aria-hidden="true"></span>

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