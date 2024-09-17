<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
	<div class="container">
		<div class="header-container">
			<a class="header__logo" href="<?= esc_url( home_url( '/' ) ); ?>">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/esther-logo.svg" alt="Esther Lases Logo">
			</a>
			<a class="header__burger">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/hamburger.svg" alt="burger">
			</a>
			<nav class="navigation">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
				] );
				?>
			</nav>
		</div>
	</div>
</header>

<?php
$phone_number           = get_field( 'phone_number', 'option' );
$email                  = get_field( 'email', 'option' );
$street_name_and_number = get_field( 'street_name_and_number', 'option' );
$postal_code_and_city   = get_field( 'postal_code_and_city', 'option' );
$kvk_number             = get_field( 'kvk_number', 'option' );
$social_media           = get_field( 'social_media', 'option' );
$contact_url            = get_field( 'contact_url', 'option' );
$privacy_url            = get_field( 'privacy_url', 'option' );
$terms_url              = get_field( 'terms_url', 'option' );
?>

<div class="mobile-menu">
	<div class="container">
		<div class="mobile-menu__top">
			<a class="mobile-menu__logo" href="<?= esc_url( home_url( '/' ) ); ?>">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/esther-logo.svg" alt="Esther Lases">
			</a>
			<a class="mobile-menu__close">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/close-red.svg" alt="close">
			</a>
		</div>

		<div class="mobile-menu__content">
			<div class="mobile-menu__navigation">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
				] );
				?>
			</div>
			<div class="mobile-menu__bottom">
				<div class="footer-top__icons">
					<?php foreach ( $social_media as $social_media_item ) : ?>
						<a target="_blank" href="<?= esc_url( $social_media_item['url'] ); ?>">
							<img src="<?= esc_url( $social_media_item['icon'] ); ?>" alt="<?= esc_attr( $social_media_item['title'] ); ?>">
						</a>
					<?php endforeach; ?>
				</div>
				<div class="footer-bottom__content">
					<a href="<?= esc_url( $privacy_url ) ?>">Privacyverklaring</a>
					|
					<a href="<?= esc_url( $terms_url ) ?>">Algemene voorwaarden</a>
					|
					<p>
						KVK <?= esc_html( $kvk_number ); ?>
					</p>
					<p>© Copyright Esther Lases <?= date( "Y" ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>