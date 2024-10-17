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
	wp_enqueue_style( 'swiper-styles', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.0.0' );

	// Main CSS
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/dist/main.css', [ 'swiper-styles' ], filemtime( get_template_directory() . '/dist/main.css' ) );

	// Swiper JS
	wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.0.0', true );

	// Main JS
	wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/dist/main.js', [ 'swiper-scripts' ], '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'enqueue_vite_built_assets' );


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

function custom_page_title( $title ) {
	return $title;
}

add_filter( 'pre_get_document_title', 'custom_page_title' );

add_theme_support( 'title-tag' );

function generate_css_variables() {
	$colors = get_field( 'colors', 'option' );

	if ( $colors ) {
		$css = "<style id='theme-custom-colors'>\n:root {\n";
		foreach ( $colors as $key => $value ) {
			$variable_name = '--' . strtolower( preg_replace( '/_/', '-', $key ) );
			$css           .= "  {$variable_name}: {$value};\n";

			// Voeg RGB-waarden toe
			$rgb = sscanf( $value, "#%02x%02x%02x" );
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

add_action( 'wp_head', 'output_css_variables', 100 );


function handle_custom_form_submission() {
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['custom_form_id'] ) ) {
		// Controleer de nonce voor beveiliging
		if ( ! isset( $_POST['custom_form_nonce_field'] ) || ! wp_verify_nonce( $_POST['custom_form_nonce_field'], 'custom_form_nonce_action' ) ) {
			return;
		}

		$form_id = intval( $_POST['custom_form_id'] );
		$fields = get_field( 'fields', $form_id );

		if ( ! $fields ) {
			return;
		}

		$errors = [];
		$data = [];
		$user_email = '';

		foreach ( $fields as $field ) {
			$field_name  = sanitize_title( $field['title'] );
			$field_value = isset( $_POST[ $field_name ] ) ? sanitize_text_field( $_POST[ $field_name ] ) : '';

			// Controleer of het veld verplicht is
			$is_required = isset( $field['required'] ) && $field['required'];

			if ( $is_required && empty( $field_value ) ) {
				$errors[ $field_name ] = 'Het veld "' . $field['title'] . '" is verplicht.';
			}

			$data[ $field_name ] = $field_value;

			// Als dit een e-mailveld is, sla het e-mailadres van de gebruiker op
			if ( $field['acf_fc_layout'] == 'email' ) {
				$user_email = sanitize_email( $field_value );
			}
		}

		if ( ! empty( $errors ) ) {
			set_transient( 'form_errors_' . $form_id, $errors, 60 );
			set_transient( 'form_data_' . $form_id, $data, 60 );
		} else {
			$form_title = get_the_title( $form_id );
			$submission_post = array(
				'post_title'  => 'Inzending voor formulier ' . $form_title . ' op ' . current_time( 'd-m-Y H:i' ),
				'post_status' => 'publish',
				'post_type'   => 'inzending',
			);

			$submission_id = wp_insert_post( $submission_post );

			// Sla form_id en form_data op als post meta
			update_post_meta( $submission_id, 'form_id', $form_id );
			update_post_meta( $submission_id, 'form_data', $data );


			set_transient( 'form_success_' . $form_id, 'Bedankt voor uw inzending.', 60 );
		}

		wp_redirect( $_SERVER['HTTP_REFERER'] );
		exit;
	}
}

add_action( 'init', 'handle_custom_form_submission' );


function custom_remove_menus() {
	$sidebar_settings = get_field( 'sidebar_settings', 'option' );

	if ( $sidebar_settings ) {
		$show_dashboard    = $sidebar_settings['dashboard'];
		$show_settings     = $sidebar_settings['settings'];
		$show_appearance   = $sidebar_settings['appearance'];
		$show_tools        = $sidebar_settings['tools'];
		$show_wp_migration = $sidebar_settings['wp_migration'];
		$show_plugins      = $sidebar_settings['plugins'];
		$show_users        = $sidebar_settings['users'];
		$show_acf          = $sidebar_settings['acf'];
		$show_wp_mail_smtp = $sidebar_settings['wp_mail_smtp'];

		if ( ! $show_dashboard ) {
			remove_menu_page( 'index.php' );
		}

		// Verberg Instellingen
		if ( ! $show_settings ) {
			remove_menu_page( 'options-general.php' );
		}

		// Verberg Weergave
		if ( ! $show_appearance ) {
			remove_menu_page( 'themes.php' );
		}

		// Verberg Gereedschap
		if ( ! $show_tools ) {
			remove_menu_page( 'tools.php' );
		}

		// Verberg All-in-One WP Migration
		if ( ! $show_wp_migration ) {
			remove_menu_page( 'ai1wm_export' );
		}

		// Verberg Plugins
		if ( ! $show_plugins ) {
			remove_menu_page( 'plugins.php' );
		}

		// Verberg Gebruikers
		if ( ! $show_users ) {
			remove_menu_page( 'users.php' );
		}

		// Verberg ACF
		if ( ! $show_acf ) {
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
		}

		// Verberg WP Mail SMTP
		if ( ! $show_wp_mail_smtp ) {
			remove_menu_page( 'wp-mail-smtp' );
		}
	}
}

add_action( 'admin_menu', 'custom_remove_menus', 999 );

function create_submission_post_type() {
	$labels = array(
		'name'               => 'Inzendingen',
		'singular_name'      => 'Inzending',
		'menu_name'          => 'Inzendingen',
		'name_admin_bar'     => 'Inzending',
		'add_new'            => 'Nieuwe toevoegen',
		'add_new_item'       => 'Nieuwe inzending toevoegen',
		'new_item'           => 'Nieuwe inzending',
		'edit_item'          => 'Inzending bewerken',
		'view_item'          => 'Inzending bekijken',
		'all_items'          => 'Alle inzendingen',
		'search_items'       => 'Zoek inzendingen',
		'parent_item_colon'  => 'Bovenliggende inzendingen:',
		'not_found'          => 'Geen inzendingen gevonden.',
		'not_found_in_trash' => 'Geen inzendingen in de prullenbak gevonden.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=form',
		'show_in_admin_bar'  => false, // Voorkom dat het in de admin bar verschijnt
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'inzending' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' ),
	);

	register_post_type( 'inzending', $args );
}
add_action( 'init', 'create_submission_post_type' );

function set_custom_submission_columns($columns) {
	unset($columns['date']);
	$columns['submission_date'] = 'Datum';
	$columns['form_title'] = 'Formulier';
	return $columns;
}
add_filter( 'manage_inzending_posts_columns', 'set_custom_submission_columns' );

function custom_submission_column( $column, $post_id ) {
	switch ( $column ) {
		case 'submission_date':
			echo get_the_date( '', $post_id );
			break;
		case 'form_title':
			$form_id = get_post_meta( $post_id, 'form_id', true );
			echo esc_html( get_the_title( $form_id ) );
			break;
	}
}
add_action( 'manage_inzending_posts_custom_column' , 'custom_submission_column', 10, 2 );


function add_submission_meta_box() {
	add_meta_box(
		'submission_data_meta_box',
		'Formuliergegevens',
		'render_submission_meta_box',
		'inzending',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_submission_meta_box' );

function render_submission_meta_box( $post ) {
	$form_data = get_post_meta( $post->ID, 'form_data', true );
	if ( $form_data && is_array( $form_data ) ) {
		echo '<table class="form-table">';
		foreach ( $form_data as $key => $value ) {
			echo '<tr>';
			echo '<th>' . esc_html( $key ) . '</th>';
			echo '<td>' . esc_html( $value ) . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<p>Geen formuliergegevens beschikbaar.</p>';
	}
}

?>