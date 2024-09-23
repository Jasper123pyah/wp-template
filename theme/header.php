<?php
	$header_links_html = '';
	if (have_rows('header_links', 'option')) {
		$header_links_html .= '<div class="header-links">';
		while (have_rows('header_links', 'option')) {
			the_row();
			$link = get_sub_field('link');
			if ($link) {
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				$header_links_html .= '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '">' . esc_html($link_title) . '</a>';
			}
		}
		$header_links_html .= '</div>';
	}

	$special_link = get_field('special_link', 'option');
	if ($special_link) {
		$special_link_url = $special_link['url'];
		$special_link_title = $special_link['title'];
		$special_link_target = $special_link['target'] ? $special_link['target'] : '_self';
		$header_links_html .= '<a class="special-link" href="' . esc_url($special_link_url) . '" target="' . esc_attr($special_link_target) . '">' . esc_html($special_link_title) . '</a>';
	}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="navbar">
	<div class="container">
		<div class="navbar__container">
			<a class="navbar__logo" href="<?= esc_url( home_url( '/' ) ); ?>">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Logo">
			</a>
			<a class="navbar__burger">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/hamburger.svg" alt="burger">
			</a>
			<nav class="navigation">
				<?php
					echo $header_links_html;
				?>
			</nav>
		</div>
	</div>
</header>

<div class="navbar--mobile">
	<div class="container">
		<div class="navbar--mobile__top">
			<a class="navbar--mobile__logo" href="<?= esc_url( home_url( '/' ) ); ?>">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Logo">
			</a>
			<a class="navbar--mobile__close">
				<img src="<?= get_template_directory_uri(); ?>/assets/images/close.svg" alt="close">
			</a>
		</div>

		<div class="navbar--mobile__content">
			<div class="navbar--mobile__navigation">
				<?php
					echo $header_links_html;
				?>
			</div>
		</div>
	</div>
</div>