        <footer class="footer">
            <section class="section__width section__width--footer">
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container' => '',
                    'menu_class' => 'nav__menu nav__menu--footer'
                ) ); ?>

                <ul class="footer__bottom">
                    <li><?php echo esc_html( get_bloginfo( 'name' ) ); ?></li>

                    <li>University of Toronto</li>
                </ul>
            </section>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
