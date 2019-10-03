<footer>
    <dl>
        <dt class="hidden-phone">&copy; University of Toronto</dt>
        <dd><a href="http://www.utoronto.ca/contacts.htm">Contacts</a></dd>
        <dd>University Switchboard: 416.978.2011</dd>
        <dd><a href="http://map.utoronto.ca">Map of Downtown Campus</a></dd>
    </dl>

    <?php //wp_nav_menu(array('theme_location' => 'footer', 'container' => FALSE)); ?>

    <?php if (is_active_sidebar('footer-social')) : ?>

        <?php dynamic_sidebar('footer-social'); ?>

    <?php endif; ?>

</footer>
</div> <!-- end container -->

<?php wp_footer(); ?>

<!-- JavaScript at the bottom for fast page loading -->

<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
<?php if (is_front_page()) : ?>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-carousel.js"></script>
<script>                     
    var width;
    var height;
              
    if (typeof window.innerWidth != 'undefined')
    {
        width = window.innerWidth,
        height = window.innerHeight
    }
        
    if (width > 767 || height > 767) {    
                    
        $('#slideshow').carousel({
            interval: 8000
        })
    }
</script>
<?php endif; ?>
<?php if (is_child_of(2076)) { // gets all header tags on the page in the content area and converts them to a list on the left. ?>
    <script>
		$(document).ready({
			$('section.span9 :header').find()
		});
    </script>
<?php } ?>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-collapse.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-dropdown.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-alert.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-transition.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>
</body>
</html>