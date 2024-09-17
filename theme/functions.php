<?php
function register_menus() {
	register_nav_menus(
		[
			'primary' => __( 'Primary Menu', 'elecho-theme' ),
		]
	);
}

function enqueue_estherlases_styles() {
	// Enqueue style.css
	wp_enqueue_style( 'estherlases-style', get_stylesheet_uri() );
	// Enqueue main.css file
	wp_enqueue_style( 'estherlases-main-style', get_template_directory_uri() . '/main.css', [], '1.0.0', 'all' );
}

function remove_posts_menu() {
	remove_menu_page( 'edit.php' );
}

function remove_admin_login_header() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

function add_google_fonts() {
	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', false );
}

function create_post_types() {
	register_post_type( 'reviews',
		[
			'labels'       => [
				'name'          => __( 'Reviews' ),
				'singular_name' => __( 'Review' ),
			],
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => [ 'slug' => 'reviews' ],
			'show_in_rest' => true,
			'supports'     => [ 'title' ],
		]
	);
}


function disable_gutenberg_editor_for_pages( $can_edit, $post_type ) {
	return false;
}

function remove_wysiwyg_for_pages() {
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'reviews', 'editor' );
}

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

function add_custom_oembed_provider() {
	wp_oembed_add_provider( '/https:\/\/calendly\.com\/*/', 'https://calendly.com/api/oembed', true );
}

function theme_enqueue_scripts() {
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/main.js', [], null, true );
}

function enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
}

function enqueue_slick_files() {
	wp_enqueue_style('slick-style', get_template_directory_uri() . '/slick/slick.css', array(), '1.8.1');
	wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/slick/slick-theme.css', array(), '1.8.1');
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), '1.8.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_files');

function custom_page_title($title) {
	return $title;
}
add_filter('pre_get_document_title', 'custom_page_title');

add_action( 'wp_enqueue_scripts', 'enqueue_jquery' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
add_action( 'init', 'add_custom_oembed_provider' );
add_action( 'admin_init', 'theme_disable_comments_everywhere' );
add_action( 'init', 'remove_wysiwyg_for_pages' );
add_filter( 'use_block_editor_for_post_type', 'disable_gutenberg_editor_for_pages', 10, 2 );
add_action( 'init', 'create_post_types' );
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );
add_action( 'get_header', 'remove_admin_login_header' );
add_action( 'admin_menu', 'remove_posts_menu' );
add_action( 'init', 'register_menus' );
add_action( 'wp_enqueue_scripts', 'enqueue_estherlases_styles' );
add_theme_support('title-tag');