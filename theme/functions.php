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
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css', array(), '1.0.0');
    wp_enqueue_script('main-scripts', get_template_directory_uri() . '/dist/main.js', array(), '1.0.0', true);
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

function enqueue_jquery() {
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_jquery' );

function custom_page_title($title) {
    return $title;
}
add_filter('pre_get_document_title', 'custom_page_title');

add_theme_support('title-tag');

function generate_scss_variables() {
    // Haal de kleuren groep op uit ACF opties
    $colors = get_field('colors', 'option'); // 'option' geeft aan dat het uit de options pagina komt

    // Controleer of de kleuren groep bestaat
    if ($colors) {
        $scss = "";
        foreach ($colors as $key => $value) {
            $variable_name = '$' . strtolower(preg_replace('/_/', '-', $key));
            $scss .= "{$variable_name}: {$value};\n";
        }

        $file_path = get_template_directory() . '/assets/styles/common/_variables.scss';

        // Schrijf de SCSS-variabelen naar het bestand
        file_put_contents($file_path, $scss);
    }
}
add_action('acf/save_post', 'generate_scss_variables', 20);

function generate_scss_variables_on_activation() {
    generate_scss_variables();
}
add_action('after_switch_theme', 'generate_scss_variables_on_activation');

?>