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
    
    <?php wp_nav_menu( array(
        'theme_location' => 'main-menu',
        'container' => '',
        'menu_class' => 'nav__menu nav__menu--main nav__bottom'
    ) ); ?>
</nav>
