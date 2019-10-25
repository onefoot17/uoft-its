<?php
    add_action( 'after_setup_theme', 'blankslate_setup' );
    function blankslate_setup() {
        load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'search-form' ) );

        global $content_width;

        if ( ! isset( $content_width ) ) {
            $content_width = 1920;
        }

        // Navigation Menu
        register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );

        add_filter( 'walker_nav_menu_start_el', 'add_arrow', 10, 4 );

        function add_arrow( $output, $item, $depth, $args ) {
            //Only add class to 'top level' items on the 'primary' menu.
            if( 'main-menu' == $args->theme_location ) {
                if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                    $output .='<i class="fas fa-angle-down nav__menu__arrow"></i>';
                }
            }
            
            return $output;
        }
    }

    // Social Links Navigation Menu
    add_action( 'init', 'register_menu_social_links' );
    function register_menu_social_links() {
        register_nav_menu( 'social-links',__( 'Social Links' ) );
    }

    // Footer Navigation Menu
    add_action( 'init', 'register_menu_footer' );
    function register_menu_footer() {
        register_nav_menu( 'footer',__( 'Footer' ) );
    }

    // Enqueue Scripts
    add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
    function blankslate_load_scripts() {
        // CSS
        wp_enqueue_style( 'blankslate-style', get_template_directory_uri() . '/build/css/styles.css' );

        // JS
        wp_enqueue_script( 'script-glide', get_template_directory_uri() . '/node_modules/@glidejs/glide/dist/glide.min.js', array(), false, true );

        wp_enqueue_script( 'script-scripts', get_template_directory_uri() . '/build/js/scripts-min.js', array(), false, true );
    }

    // Remove auto tags on Index page    
    function removeP(){
        if ( is_front_page() ) {
            remove_filter ('the_excerpt', 'wpautop');
            
            remove_filter('the_content', 'wpautop');
        }
    }
    
    add_action( 'template_redirect', 'removeP' );
    
    // SVG Upload
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
      }
      add_filter('upload_mimes', 'cc_mime_types');

      //Page Slug Body Class
      function add_slug_body_class( $classes ) {
          global $post;

          if ( isset( $post ) ) {
              $classes[] = $post->post_type . '-' . $post->post_name;
            }

            return $classes;
        }
        add_filter( 'body_class', 'add_slug_body_class' );
?>
