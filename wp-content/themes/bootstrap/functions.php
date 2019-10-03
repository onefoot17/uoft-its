<?php

// update_option('siteurl','http://main.its.utoronto.ca');
// update_option('home','http://main.its.utoronto.ca');

add_action( 'init', 'its_add_excerpts_to_pages' );
function its_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


/* =============================================================================
  Add RSS Links to <head>
  ========================================================================== */

automatic_feed_links();

/* =============================================================================
  Load jQuery
  ========================================================================== */

if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('jquery');
}

/* =============================================================================
  Clean up <head>
  ========================================================================== */

function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

/* =============================================================================
  Register Menus
  ========================================================================== */
/*
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
	'utilities' => ('Utilities'),
	'main' => __('Main'),
	'footer' => __('Footer'),
	'act' => __('ACT Unit'),
	'boa' => __('BOA Unit'),
	'easi' => __('EASI Unit'),
	'eis' => __('EIS Unit'),
	'isea' => __('ISEA Unit'),
	'ics' => __('ICS Unit'),
	'cio' => __('CIO Unit'),
	'ols' => __('OLS Unit'),
	'pgac' => __('PGAC Unit')
    ));
}*/


if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
	
	'main' => __('Main'),
	'header_right' => __('Header Right'),
  'main-demo' => __('DEMO Landing Page Main'),
	
    ));
}

/* =============================================================================
  Register Sidebars
  ========================================================================== */

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

/* =============================================================================
  Display Custom Fields -- <?php custom_field('student');
  ========================================================================== */

function custom_field($field = NULL, $before = NULL, $after = NULL, $echo = TRUE) {
    global $post;
    $output = get_post_meta($post->ID, $field, $single = true);
    if ($output !== '') {
	$content = $before;
	$content .= $output;
	$content .= $after;
	if ($echo) {
	    echo $content;
	} else {
	    return $content;
	}
    }
    return FALSE;
}

/* =============================================================================
  Check if post has a certain term in chosen taxonomy
  ========================================================================== */

function term_in_taxonomy($tax, $term, $_post = NULL) {
    if (!$tax || !$term) {
	return FALSE;
    }

    if ($_post) {
	$_post = get_post($_post);
    } else {
	$_post = & $GLOBALS['post'];
    }

    if (!$_post) {
	return FALSE;
    }

    $return = is_object_in_term($_post->ID, $tax, $term);

    if (is_wp_error($return)) {
	return FALSE;
    }
    return $return;
}

/* =============================================================================
  List taxonomy terms without links
  ========================================================================== */

function terms_no_links($post, $tax) {

    $terms = get_the_terms($post, $tax);

    if ($terms && !is_wp_error($terms)) {
	$return = array();
	foreach ($terms as $term) {
	    $return[] = $term->name;
	}
	$return = join(", ", $return);
    }
    return $return;
}

/* =============================================================================
  Add ability to use Tags on Pages and show in search results
  ========================================================================== */

function add_page_tags() {
    register_taxonomy_for_object_type('post_tag', 'page');
}

add_filter('request', 'expanded_request');

function expanded_request($q) {
    if (isset($q['tag']))
	$q['post_type'] = array('post', 'page');
    return $q;
}

add_action('init', 'add_page_tags');
add_action('init', 'expanded_request');

/* =============================================================================
  Service Post Type
  ========================================================================== */
/*
register_post_type('service', array(
    'label' => 'Services',
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => get_bloginfo('template_directory') . '/images/posts/rolodex.png',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array('slug' => ''),
    'query_var' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'revisions', 'comments'),
    'taxonomies' => array('audience', 'units', 'service-category', 'permission', 'browser', 'post_tag'),
    'labels' => array(
	'name' => _x('Services', 'post type general name'),
	'singular_name' => _x('Service', 'post type singular name'),
	'add_new' => _x('Add New', 'service'),
	'add_new_item' => __('Add New Service'),
	'edit_item' => __('Edit Service'),
	'new_item' => __('New Service'),
	'all_items' => __('All Services'),
	'view_item' => __('View Service'),
	'search_items' => __('Search Services'),
	'not_found' => __('No services found'),
	'not_found_in_trash' => __('No services found in Trash'),
	'parent_item_colon' => '',
	'menu_name' => 'Services'
    ),));*/

/* =============================================================================
  News Post Type
  ========================================================================== */

register_post_type('news', array(
    'label' => 'News',
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => get_bloginfo('template_directory') . '/images/posts/newspaper.png',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array('slug' => ''),
    'query_var' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'comments'),
    'taxonomies' => array('audience', 'units', 'service-category', 'post_tag',),
    'labels' => array(
	'name' => _x('News', 'post type general name'),
	'singular_name' => _x('News', 'post type singular name'),
	'add_new' => _x('Add New', 'news'),
	'add_new_item' => __('Add New News'),
	'edit_item' => __('Edit News'),
	'new_item' => __('New News'),
	'all_items' => __('All News'),
	'view_item' => __('View News'),
	'search_items' => __('Search News'),
	'not_found' => __('No news found'),
	'not_found_in_trash' => __('No news found in Trash'),
	'parent_item_colon' => '',
	'menu_name' => 'News'
    ),));



//Add the meta box callback function
/*add_action("save_post", "save_case_study_parent_id");
function admin_init(){
add_meta_box("case_study_parent_id", "News Page Parent ID", "set_case_study_parent_id", "News", "side");
}
add_action("admin_init", "admin_init");

//Meta box for setting the parent ID
function set_case_study_parent_id() {
  global $post;
  //echo $post->ID;
 $custom = get_post_custom($post->ID);
 //print_r($custom);
  echo $parent_id = $custom['parent_id'][0];
  ?>
  <p>Please specify the ID of the page  to be a parent to this page.</p>
  <p>Leave blank for no heirarchy.  News will appear from the server root with no assocaited parent page.</p>
  <input type="text" id="parent_id" name="parent_id" value="<?php echo $post->post_parent; ?>" />
  <?php
  // create a custom nonce for submit verification later
 // echo '<input type="hidden" name="parent_id_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

// Save the meta data
function save_case_study_parent_id($post_id) {
  global $post;
//echo $_POST['parent_id'];
  // make sure data came from our meta box
  if (!wp_verify_nonce($_POST['parent_id_noncename'],__FILE__)) return $post_id;
    if(isset($_POST['parent_id']) && ($_POST['post_type'] == "News")) {
      $data = $_POST['parent_id'];
	 // print_r($data);
      update_post_meta($post_id, 'parent_id', $data);
	  
    }
}
*/



/* =============================================================================
  Slideshow Post Type
  ========================================================================== */

/*register_post_type('slideshow', array(
    'label' => 'Slideshow',
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => get_bloginfo('template_directory') . '/images/posts/pictures-stack.png',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array('slug' => ''),
    'query_var' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'labels' => array(
	'name' => _x('Slideshow', 'post type general name'),
	'singular_name' => _x('Slide', 'post type singular name'),
	'add_new' => _x('Add New', 'slide'),
	'add_new_item' => __('Add New Slide'),
	'edit_item' => __('Edit Slide'),
	'new_item' => __('New Slide'),
	'all_items' => __('All Slides'),
	'view_item' => __('View Slide'),
	'search_items' => __('Search Slideshow'),
	'not_found' => __('No slides found'),
	'not_found_in_trash' => __('No slides found in Trash'),
	'parent_item_colon' => '',
	'menu_name' => 'Slideshow'
    ),));
*/
/* =============================================================================
  FAQ Post Type
  ========================================================================== */
/*
register_post_type('faq', array(
    'label' => 'FAQ\'s',
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => get_bloginfo('template_directory') . '/images/posts/faq.png',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array('slug' => ''),
    'query_var' => true,
    'supports' => array('title', 'editor'),
    'taxonomies' => array('post_tag'),
    'labels' => array(
	'name' => _x('Frequently Asked Questions', 'post type general name'),
	'singular_name' => _x('Slide', 'post type singular name'),
	'add_new' => _x('Add New', 'slide'),
	'add_new_item' => __('Add New FAQ'),
	'edit_item' => __('Edit FAQ'),
	'new_item' => __('New FAQ'),
	'all_items' => __('All FAQ\'s'),
	'view_item' => __('View FAQ'),
	'search_items' => __('Search FAQ\'s'),
	'not_found' => __('No FAQ\'s found'),
	'not_found_in_trash' => __('No FAQ\'s found in Trash'),
	'parent_item_colon' => '',
	'menu_name' => 'FAQ\'s'
    ),));*/


/* =============================================================================
  Add Post Tags to Custom Posts
  ========================================================================== */

add_action('init', 'service_add_default_boxes');

function service_add_default_boxes() {
   // register_taxonomy_for_object_type('post_tag', 'service');
    register_taxonomy_for_object_type('post_tag', 'news');
   // register_taxonomy_for_object_type('post_tag', 'faq');
}

/* =============================================================================
  Unit Taxonomy
  ========================================================================== */
/*
register_taxonomy('units', array('service', 'news'), array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'unit'),
    'labels' => array(
	'name' => _x('Unit', 'taxonomy general name'),
	'singular_name' => _x('Unit', 'taxonomy singular name'),
	'search_items' => __('Search Units'),
	'all_items' => __('All Units'),
	'parent_item' => __('Parent Unit'),
	'parent_item_colon' => __('Parent Unit:'),
	'edit_item' => __('Edit Unit'),
	'update_item' => __('Update Unit'),
	'add_new_item' => __('Add New Unit'),
	'new_item_name' => __('New Unit Name'),
	'menu_name' => __('Unit'),
    ),));*/

/* =============================================================================
  Service Category Taxonomy
  ========================================================================== */

/*register_taxonomy('service-category', array('service', 'news'), array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'service-category'),
    'labels' => array(
	'name' => _x('Service Category', 'taxonomy general name'),
	'singular_name' => _x('Service Category', 'taxonomy singular name'),
	'search_items' => __('Search Service Categories'),
	'all_items' => __('All Service Categories'),
	'parent_item' => __('Parent Service Category'),
	'parent_item_colon' => __('Parent Service Category:'),
	'edit_item' => __('Edit Service Category'),
	'update_item' => __('Update Service Category'),
	'add_new_item' => __('Add New Service Category'),
	'new_item_name' => __('New Service Category Name'),
	'menu_name' => __('Service Category'),
    ),));*/

/* =============================================================================
  Audience Taxonomy
  ========================================================================== */

/*register_taxonomy('audience', array('service', 'news'), array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'audience'),
    'labels' => array(
	'name' => _x('Audience', 'taxonomy general name'),
	'singular_name' => _x('Audience', 'taxonomy singular name'),
	'search_items' => __('Search Audiences'),
	'all_items' => __('All Audiences'),
	'edit_item' => __('Edit Audience'),
	'update_item' => __('Update Audience'),
	'add_new_item' => __('Add New Audience'),
	'new_item_name' => __('New Audience Name'),
	'menu_name' => __('Audience'),
    ),));*/


/* =============================================================================
  Supported Browser Taxonomy
  ========================================================================== */

/*register_taxonomy('browser', 'service', array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'browser'),
    'labels' => array(
	'name' => _x('Supported Browsers', 'taxonomy general name'),
	'singular_name' => _x('Supported Browsers', 'taxonomy singular name'),
	'search_items' => __('Search Supported Browsers'),
	'all_items' => __('All Supported Browsers'),
	'parent_item' => __('Parent Browser'),
	'parent_item_colon' => __('Parent Browser:'),
	'edit_item' => __('Edit Supported Browsers'),
	'update_item' => __('Update Supported Browsers'),
	'add_new_item' => __('Add New Supported Browser'),
	'new_item_name' => __('New Supported Browser'),
	'menu_name' => __('Supported Browsers'),
    ),));*/

/* =============================================================================
  Access Permission Taxonomy
  ========================================================================== */

/*register_taxonomy('permission', 'service', array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'permission'),
    'labels' => array(
	'name' => _x('Access Permission', 'taxonomy general name'),
	'singular_name' => _x('Access Permission', 'taxonomy singular name'),
	'search_items' => __('Search Permissions'),
	'all_items' => __('All Permissions'),
	'edit_item' => __('Edit Permission'),
	'update_item' => __('Update Permission'),
	'add_new_item' => __('Add New Permission'),
	'new_item_name' => __('New Permission Name'),
	'menu_name' => __('Access Permission'),
    ),));
*/

/* =============================================================================
  Change FAQ Title Placeholder
  ========================================================================== */

/*function change_default_title($title) {
    $screen = get_current_screen();

    if ('faq' == $screen->post_type) {
	$title = 'Enter The Question';
    }

    return $title;
}

add_filter('enter_title_here', 'change_default_title');*/

/* =============================================================================
  Service Meta
  ========================================================================== */
/*
add_action('load-post.php', 'setup_service_meta');
add_action('load-post-new.php', 'setup_service_meta');

function setup_service_meta() {
    add_action('add_meta_boxes', 'add_service_meta');
    add_action('save_post', 'save_service_meta', 1, 2);
}

function add_service_meta() {
    add_meta_box('service_homepage', 'Link to the Service Homepage', 'display_homepage_meta', 'service', 'normal', 'high');
    add_meta_box('service_location', 'Google Maps Link', 'display_location_meta', 'service', 'normal', 'high');
    add_meta_box('service_availability_box', 'Availability of Service', 'display_availability_meta', 'service', 'normal', 'high');
    add_meta_box('service_hours_box', 'Hours for Service Support', 'display_hours_meta', 'service', 'normal', 'high');
    add_meta_box('service_support', 'Service Support Contact', 'display_support_meta', 'service', 'normal', 'high');
    add_meta_box('service_feedback', 'Service Feedback Email', 'display_feedback_meta', 'service', 'normal', 'high');
    add_meta_box('service_training', 'Link to Service Training', 'display_training_meta', 'service', 'normal', 'high');
    add_meta_box('service_documentation', 'Link to Service Documentation', 'display_documentation_meta', 'service', 'normal', 'high');
    add_meta_box('service_forms', 'Link to Service Forms', 'display_forms_meta', 'service', 'normal', 'high');
    add_meta_box('service_policies', 'Link to Service Policies', 'display_policies_meta', 'service', 'normal', 'high');
    add_meta_box('service_charges', 'Service Charges', 'display_charges_meta', 'service', 'normal', 'high');
    add_meta_box('service_login', 'Link to Login Page', 'display_login_meta', 'service', 'normal', 'high');
}

function display_homepage_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_homepage_nonce');
    echo '<input type="text" name="service_homepage" id="service_homepage" value="' . get_post_meta($post->ID, 'service_homepage', true) . '" class="widefat" />';
}

function display_location_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_location_nonce');
    echo '<input type="text" name="service_location" id="service_location" value="' . get_post_meta($post->ID, 'service_location', true) . '" class="widefat" />';
}

function display_availability_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_availability_nonce');
    $content = get_post_meta($post->ID, 'service_availability', false);
    wp_editor($content[0], 'service_availability');
}

function display_hours_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_hours_nonce');
    $content = get_post_meta($post->ID, 'service_hours', false);
    wp_editor($content[0], 'service_hours');
}

function display_support_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_support_nonce');
    echo '<input type="text" name="service_support" id="service_support" value="' . get_post_meta($post->ID, 'service_support', true) . '" class="widefat" />';
}

function display_feedback_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_feedback_nonce');
    echo '<input type="text" name="service_feedback" id="service_feedback" value="' . get_post_meta($post->ID, 'service_feedback', true) . '" class="widefat" />';
}

function display_training_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_training_nonce');
    echo '<input type="text" name="service_training" id="service_training" value="' . get_post_meta($post->ID, 'service_training', true) . '" class="widefat" />';
}

function display_documentation_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_documentation_nonce');
    echo '<input type="text" name="service_documentation" id="service_documentation" value="' . get_post_meta($post->ID, 'service_documentation', true) . '" class="widefat" />';
}

function display_forms_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_forms_nonce');
    echo '<input type="text" name="service_forms" id="service_forms" value="' . get_post_meta($post->ID, 'service_forms', true) . '" class="widefat" />';
}

function display_policies_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_policies_nonce');
    echo '<input type="text" name="service_policies" id="service_policies" value="' . get_post_meta($post->ID, 'service_policies', true) . '" class="widefat" />';
}

function display_charges_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_charges_nonce');

    $selected = get_post_meta($post->ID, 'service_charges', true);
    if ($selected == "Yes") {
	echo '<select name="service_charges" id="service_charges"><option selected>Yes</option>';
    } else {
	echo '<select name="service_charges" id="service_charges"><option>Yes</option>';
    }
    if ($selected == "May Apply") {
	echo '<option selected>May Apply</option>';
    } else {
	echo '<option>May Apply</option>';
    }
    if ($selected == "N/A") {
	echo '<option selected>N/A</option></select>';
    } else {
	echo '<option>N/A</option></select>';
    }
}

function display_login_meta() {
    global $post;
    wp_nonce_field(basename(__FILE__), 'service_login_nonce');
    echo '<input type="text" name="service_login" id="service_login" value="' . get_post_meta($post->ID, 'service_login', true) . '" class="widefat" />';
}

function save_service_meta($post_id, $post) {
    $post_type = get_post_type_object($post->post_type);

    if (!current_user_can($post_type->cap->edit_post, $post_id)) {
	return $post_id;
    }

    if ((!isset($_POST['service_homepage_nonce']) || !wp_verify_nonce($_POST['service_homepage_nonce'], basename(__FILE__))) || (!isset($_POST['service_location_nonce']) || !wp_verify_nonce($_POST['service_location_nonce'], basename(__FILE__))) || (!isset($_POST['service_availability_nonce']) || !wp_verify_nonce($_POST['service_availability_nonce'], basename(__FILE__))) || (!isset($_POST['service_hours_nonce']) || !wp_verify_nonce($_POST['service_hours_nonce'], basename(__FILE__))) || (!isset($_POST['service_support_nonce']) || !wp_verify_nonce($_POST['service_support_nonce'], basename(__FILE__))) || (!isset($_POST['service_feedback_nonce']) || !wp_verify_nonce($_POST['service_feedback_nonce'], basename(__FILE__))) || (!isset($_POST['service_training_nonce']) || !wp_verify_nonce($_POST['service_training_nonce'], basename(__FILE__))) || (!isset($_POST['service_documentation_nonce']) || !wp_verify_nonce($_POST['service_documentation_nonce'], basename(__FILE__))) || (!isset($_POST['service_forms_nonce']) || !wp_verify_nonce($_POST['service_forms_nonce'], basename(__FILE__))) || (!isset($_POST['service_policies_nonce']) || !wp_verify_nonce($_POST['service_policies_nonce'], basename(__FILE__))) || (!isset($_POST['service_charges_nonce']) || !wp_verify_nonce($_POST['service_charges_nonce'], basename(__FILE__))) || (!isset($_POST['service_login_nonce']) || !wp_verify_nonce($_POST['service_login_nonce'], basename(__FILE__)))) {
	return $post_id;
    }

    foreach ($_POST as $meta_key => $new_meta_value) {
	$meta_value = get_post_meta($post_id, $meta_key, true);
	if ($new_meta_value && '' == $meta_value) {
	    add_post_meta($post_id, $meta_key, $new_meta_value, true);
	} elseif ($new_meta_value && $new_meta_value != $meta_value) {
	    update_post_meta($post_id, $meta_key, $new_meta_value);
	} elseif ('' == $new_meta_value && $meta_value) {
	    delete_post_meta($post_id, $meta_key, $meta_value);
	}
    }
}*/

/* =============================================================================
  Enable Bootstrap Menus
  ========================================================================== */

add_action('after_setup_theme', 'bootstrap_setup');

function bootstrap_setup() {

    class bootstrap_walker extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = array()) {

	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

	    $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

	    $li_attributes = '';
	    $class_names = $value = '';

	    $classes = empty($item->classes) ? array() : (array) $item->classes;
	    $classes[] = ($args->has_children) ? 'dropdown' : '';
	    $classes[] = ($item->current) ? 'active' : '';
	    $classes[] = 'menu-item-' . $item->ID;

	    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
	    $class_names = ' class="' . esc_attr($class_names) . '"';

	    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
	    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

	    $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

	    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
	    $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
	    $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
	    $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
	    $attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

	    $item_output = $args->before;
	    $item_output .= '<a' . $attributes . '>';
	    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
	    $item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
	    $item_output .= $args->after;

	    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

	    if (!$element)
		return;

	    $id_field = $this->db_fields['id'];

	    // display this element
	    if (is_array($args[0]))
		$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
	    else if (is_object($args[0]))
		$args[0]->has_children = !empty($children_elements[$element->$id_field]);
	    $cb_args = array_merge(array(&$output, $element, $depth), $args);
	    call_user_func_array(array(&$this, 'start_el'), $cb_args);

	    $id = $element->$id_field;

	    // descend only when the depth is right and there are childrens for this element
	    if (($max_depth == 0 || $max_depth > $depth + 1 ) && isset($children_elements[$id])) {

		foreach ($children_elements[$id] as $child) {

		    if (!isset($newlevel)) {
			$newlevel = true;
			//start the child delimiter
			$cb_args = array_merge(array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
		    }
		    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
		}
		unset($children_elements[$id]);
	    }

	    if (isset($newlevel) && $newlevel) {
		//end the child delimiter
		$cb_args = array_merge(array(&$output, $depth), $args);
		call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
	    }

	    //end this element
	    $cb_args = array_merge(array(&$output, $element, $depth), $args);
	    call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}

    }

}

/* =============================================================================
  Comments Callback
  ========================================================================== */

function custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
	case '' :
	    ?>
	    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	        <div id="comment-<?php comment_ID(); ?>">
	    	<div class="comment-author vcard">
			<?php echo get_avatar($comment, 40); ?>
			<?php printf(__('%s <span class="says">says:</span>', 'WP_Bootstrap'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
	    	</div>
		    <?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'WP_Bootstrap'); ?></em>
			<br />
		    <?php endif; ?>

	    	<div class="comment-meta commentmetadata">
	    	    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
			    <?php printf(__('%1$s at %2$s', 'WP_Bootstrap'), get_comment_date(), get_comment_time()); ?>
	    	    </a>
			<?php edit_comment_link(__('(Edit)', 'WP_Bootstrap'), ' '); ?>
	    	</div>

	    	<div class="comment-body"><?php comment_text(); ?></div>

	    	<div class="reply">
			<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	    	</div>
	        </div>

		<?php
		break;
	    case 'pingback' :
	    case 'trackback' :
		?>
	    <li class="post pingback">
	        <p>
		    <?php _e('Pingback:', 'WP_Bootstrap'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'WP_Bootstrap'), ' '); ?>
	        </p>
		<?php
		break;
	endswitch;
    }

    /* =============================================================================
      Close Comments after 30 days
      ========================================================================== */

    function close_comments($posts) {
	if (!is_single()) {
	    return $posts;
	}
	if (time() - strtotime($posts[0]->post_date_gmt) > ( 30 * 24 * 60 * 60 )) {
	    $posts[0]->comment_status = 'closed';
	    $posts[0]->ping_status = 'closed';
	}
	return $posts;
    }

    add_filter('the_posts', 'close_comments');

    /* =============================================================================
      Check if Subpage
      ========================================================================== */

    function is_subpage() {
	global $post;

	if (is_page() && $post->post_parent) {
	    return $post->post_parent;
	} else {
	    return false;
	}
    }

    /* =============================================================================
      Add Read More link to Wordpress generated Excerpts
      ========================================================================== */

    function new_excerpt_more() {
	global $post;
	return ' <br/>[ <a class="moretag" href="' . get_permalink($post->ID) . '">Read More</a> ]';
    }

    add_filter('excerpt_more', 'new_excerpt_more');

    /* =============================================================================
      Featured Image Support
      ========================================================================== */

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150, true);

    /* =============================================================================
      Additional Image Sizes
      ========================================================================== */

    //add_image_size('slideshow', 570, 270, true); // Responsive Themes
    //add_image_size('banner', 740, 240, true);
    add_image_size('news', 250, 200, true);
    add_image_size('news_thumb', 125, 100, true);

    /* =============================================================================
      Add 3.1 Post format theme support
      ========================================================================== */

    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video'));
	
	
	
	
/*	----- */

/*add_action('do_meta_boxes', 'custom_metabox');
add_action( 'save_post', 'custom_checkbox_save' );
function custom_metabox(){
    //remove_meta_box( 'postimagediv', 'post', 'side' );
    add_meta_box('my_custom_checkbox', __('Featured Page'), 'custom_checkbox', 'news', 'side');
}

function custom_checkbox() {
	echo $post_id;
	echo get_post_meta($post->ID, 'myplugin_custom_checkbox', true);
	echo '<br>=========<br>';
	print_r($post);
	// Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );	
  // The actual fields for data entry
  echo '<input type="checkbox"  name="myplugin_custom_checkbox"  />';
  echo '<label for="myplugin_new_field">';
       _e("Check this box to make this a featured page. (Maximum 4 featured pages)" );
  echo '</label> ';
}

function custom_checkbox_save($post_id){
	
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;


	// Check permissions
	if ( 'page' == $_POST['post_type'] ) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	}
	  
	$post_id = $_POST['post_id'];
  	$mydata = $_POST['myplugin_custom_checkbox'];
	update_post_meta($post_id, 'my_custom_checkbox', $mydata);

		
}*/

/********************Add featured page for News************************/


$prefix = 'dbt_';
$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Featured Page',
    'page' => 'page',
    'context' => 'side',
    'fields' => array(
        array(
            'name' => 'Checkbox',
            'id' => $prefix . 'checkbox',
            'type' => 'checkbox'
        )
    )
);


///////////////////////////////////////////////////////////
/////////////////// add meta box///////////////////////////
///////////////////////////////////////////////////////////


add_action('admin_menu', 'mytheme_add_box');
// Add meta box
function mytheme_add_box() {
    global $meta_box;
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}


///////////////////////////////////////////////////////////
// Callback function to show fields in meta box////////////
///////////////////////////////////////////////////////////
function mytheme_show_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
   
    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
       
        switch ($field['type']) {
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo '<label for="myplugin_new_field">';
       _e("Check this box to make this a featured page. (Maximum 4 featured pages)" );
  echo '</label> ';
                break;
        }
    
    }
    
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
