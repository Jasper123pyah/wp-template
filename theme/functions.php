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
			// Ongeldige nonce, verwerk het formulier niet
			return;
		}

		$form_id = intval( $_POST['custom_form_id'] );

		// Haal de formulier velden op
		$fields = get_field( 'fields', $form_id );

		if ( ! $fields ) {
			return;
		}

		// Verwerk de formuliergegevens
		$errors     = [];
		$data       = [];
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
			// Sla fouten en data op in transients om terug te tonen in het formulier
			set_transient( 'form_errors_' . $form_id, $errors, 60 );
			set_transient( 'form_data_' . $form_id, $data, 60 );
		} else {
			// Alles is goed, stuur e-mails

			// Admin e-mail
			$admin_email = get_option( 'admin_email' ); // Of haal het op uit je opties

			$subject = 'Nieuw formulier inzending';
			$message = '';

			foreach ( $data as $key => $value ) {
				$message .= $key . ': ' . $value . "\n";
			}

			// Headers voor de e-mail
			$headers = [
				'Content-Type: text/plain; charset=UTF-8',
				'From: ' . get_bloginfo( 'name' ) . ' <' . $admin_email . '>',
			];

			// Stuur e-mail naar admin
			wp_mail( $admin_email, $subject, $message, $headers );

			// Controleer of er een bevestigingsbericht is ingesteld
			$confirmation_message = get_field( 'confirmation', $form_id );

			if ( ! empty( $confirmation_message ) && ! empty( $user_email ) ) {
				// Stuur bevestigingsmail naar gebruiker
				$confirmation_subject = 'Bevestiging van uw inzending';
				$confirmation_headers = [
					'Content-Type: text/plain; charset=UTF-8',
					'From: ' . get_bloginfo( 'name' ) . ' <' . $admin_email . '>',
				];

				wp_mail( $user_email, $confirmation_subject, $confirmation_message, $confirmation_headers );
			}

			// Toon succesbericht
			set_transient( 'form_success_' . $form_id, 'Bedankt voor uw inzending.', 60 );
		}

		// Redirect terug naar de formulierpagina om resubmissie te voorkomen
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

?>