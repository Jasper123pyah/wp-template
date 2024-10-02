<?php
function register_menus() {
    register_nav_menus(
        [
            'primary' => 'Primary Menu',
        ]
    );
}
add_action( 'init', 'register_menus' );

function enqueue_vite_built_assets() {
    // Swiper CSS
    wp_enqueue_style('swiper-styles', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');

    // Main CSS
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css', array('swiper-styles'), '1.0.0');

    // Swiper JS
    wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);

    // Main JS
    wp_enqueue_script('main-scripts', get_template_directory_uri() . '/dist/main.js', array('swiper-scripts'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_vite_built_assets');


function remove_posts_menu() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_posts_menu' );

function remove_admin_login_header() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'remove_admin_login_header' );

function disable_gutenberg_editor_for_pages( $can_edit, $post_type ) {
    return false;
}
add_filter( 'use_block_editor_for_post_type', 'disable_gutenberg_editor_for_pages', 10, 2 );

function remove_wysiwyg_for_pages() {
    remove_post_type_support( 'page', 'editor' );
}
add_action( 'init', 'remove_wysiwyg_for_pages' );

function theme_disable_comments_everywhere() {
    // Post types
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }

    // Close comments on the front-end
    add_filter( 'comments_open', '__return_false', 20, 2 );
    add_filter( 'pings_open', '__return_false', 20, 2 );

    // Hide existing comments
    add_filter( 'comments_array', '__return_empty_array', 10, 2 );

    // Remove comments page in menu
    remove_menu_page( 'edit-comments.php' );

    // Redirect any user trying to access comments page
    global $pagenow;
    if ( $pagenow === 'edit-comments.php' ) {
        wp_redirect( admin_url() );
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

    // Remove comments links from admin bar
    if ( is_admin_bar_showing() ) {
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
}
add_action( 'admin_init', 'theme_disable_comments_everywhere' );

function custom_page_title($title) {
    return $title;
}
add_filter('pre_get_document_title', 'custom_page_title');

add_theme_support('title-tag');

function generate_css_variables() {
    $colors = get_field('colors', 'option');

    if ($colors) {
        $css = "<style id='theme-custom-colors'>\n:root {\n";
        foreach ($colors as $key => $value) {
            $variable_name = '--' . strtolower(preg_replace('/_/', '-', $key));
            $css .= "  {$variable_name}: {$value};\n";
            
            // Voeg RGB-waarden toe
            $rgb = sscanf($value, "#%02x%02x%02x");
            $css .= "  {$variable_name}-rgb: {$rgb[0]}, {$rgb[1]}, {$rgb[2]};\n";
        }
        $css .= "}\n</style>";

        return $css;
    }

    return '';
}

function output_css_variables() {
    echo generate_css_variables();
}
add_action('wp_head', 'output_css_variables', 100);

?>