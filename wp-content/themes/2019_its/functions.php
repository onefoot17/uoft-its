<?php
    add_action( 'after_setup_theme', 'its_2019_setup' );
    function its_2019_setup() {
        load_theme_textdomain( 'its_2019', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'search-form' ) );

        global $content_width;

        if ( ! isset( $content_width ) ) {
            $content_width = 1920;
        }

        // Navigation Menu
        register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'its_2019' ) ) );

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
    add_action( 'wp_enqueue_scripts', 'its_2019_load_scripts' );
    function its_2019_load_scripts() {
        // CSS
        wp_enqueue_style( 'its_2019-style', get_template_directory_uri() . '/build/css/styles.css' );

        // JS
        wp_enqueue_script( 'script-glide', get_template_directory_uri() . '/node_modules/@glidejs/glide/dist/glide.min.js', array(), false, true );

        wp_enqueue_script( 'script-scripts', get_template_directory_uri() . '/build/js/scripts-min.js', array(), false, true );
    }

    // Remove auto tags on Index page    
    function removeP() {
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

    // Register Sidebars
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
        'name' => 'Home Page',
        'id' => 'home',
        'description' => 'Home Page Widget (3)',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Search Results Page',
        'id' => 'search-results',
        'description' => 'Search Results Page Widget (1)',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Service Landing Page',
        'id' => 'service-landing',
        'description' => 'Service Landing Page Widgets (2)',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Unit/Standard Page',
        'id' => 'standard',
        'description' => 'Unit + Standard Page Widgets (2)',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Standard Page Sidebar Menu',
        'id' => 'standard_menu',
        'description' => 'Standard Page Sidebar Menu',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Footer Social Media Icons',
        'id' => 'footer-social',
        'description' => 'Footer Social Media Icons',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
        ));
        register_sidebar(array(
        'name' => 'Alert Message',
        'id' => 'alert-message',
        'description' => 'Warnings about Service outages',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<strong>',
        'after_title' => '</strong>'
        ));
        register_sidebar(array(
        'name' => 'Regular Message',
        'id' => 'regular-message',
        'description' => 'News Bulletin or Gereral Message ',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<strong>',
        'after_title' => '</strong>'
        ));
    }

    /////////////////////////////////////////////
//////////// save meta box //////////////////
/////////////////////////////////////////////

add_action('save_post', 'mytheme_save_data');
// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}


function get_depth($id = '', $depth = '', $i = 0)
{
	global $wpdb;

	if($depth == '')
	{
		if(is_page())
		{
			if($id == '')
			{
				global $post;
				$id = $post->ID;
			}
			$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$id."'");
			return get_depth($id, $depth, $i);
		}
		elseif(is_category())
		{

			if($id == '')
			{
				global $cat;
				$id = $cat;
			}
			$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
			return get_depth($id, $depth, $i);
		}
		elseif(is_single())
		{
			if($id == '')
			{
				$category = get_the_category();
				$id = $category[0]->cat_ID;
			}
			$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$id."'");
			return get_depth($id, $depth, $i);
		}
	}
	elseif($depth == '0')
	{
		return $i;
	}
	elseif(is_single() || is_category())
	{
		$depth = $wpdb->get_var("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = '".$depth."'");
		$i++;
		return get_depth($id, $depth, $i);
	}
	elseif(is_page())
	{
		$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$depth."'");
		$i++;
		return get_depth($id, $depth, $i);
	}
}

function is_child_of( $page_id, $potential_child_id = '' ) {
  $is_child = false;
   
  if ( ! is_int( $page_id ) ) {
    $page = get_page_by_path( $page_id );
    $page_id = empty( $page ) ? 0 : $page->ID;
  }
   
  if ( empty( $potential_child_id ) ) {
    $potential_child_id = get_the_ID();
  }
   
  $potential_child = get_page( $potential_child_id );
   
  if ( ! empty( $potential_child ) && is_array( $potential_child->ancestors ) ) {
    $is_child = in_array( $page_id, $potential_child->ancestors );
  }
   
  return $is_child;
}
?>
