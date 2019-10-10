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

        // Navigation
        register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
    }

    // Social Links Navigation
    add_action( 'init', 'register_menu_social_links' );
    function register_menu_social_links() {
        register_nav_menu('social-links',__( 'Social Links' ));
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
?>
