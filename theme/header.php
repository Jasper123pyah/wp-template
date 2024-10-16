<?php 
    $header_links = get_field('header_links', 'option');
    $logo = get_field('logo', 'option');
    $burger = get_field('icons', 'option')['burger_menu'];
    $close = get_field('icons', 'option')['close'];
    $special_link = get_field('special_link', 'option');
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
                <img src="<?=$logo['url']?>" alt="<?=$logo['alt']?>">
            </a>
            <a class="navbar__burger navbar__icon" href="javascript:void(0);">
                <?=$burger?>
            </a>
            <nav class="navigation">
                <?php foreach ($header_links as $link_item) : ?>
                    <?php 
                        $link = $link_item['link']['link']; 
                        $sub_links = $link_item['link']['sub_links'];
                    ?>
                    <div class="navigation__item">
                        <a href="<?= esc_url($link['url']); ?>" class="navigation__link" <?= $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                            <?= esc_html($link['title']); ?>
                        </a>
                        <?php if ($sub_links) : ?>
                            <ul class="navigation__submenu">
                                <?php foreach ($sub_links as $sub_link_item) : ?>
                                    <?php $sub_link = $sub_link_item['sub_link']; ?>
                                    <li class="navigation__submenu-item">
                                        <a href="<?= esc_url($sub_link['url']); ?>" class="navigation__submenu-link" <?= $sub_link['target'] ? 'target="' . esc_attr($sub_link['target']) . '"' : ''; ?>>
                                            <?= esc_html($sub_link['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if ($special_link) : ?>
                    <a href="<?= esc_url($special_link['url']); ?>" class="button light-background" <?= $special_link['target'] ? 'target="' . esc_attr($special_link['target']) . '"' : ''; ?>>
                        <?= esc_html($special_link['title']); ?>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>

<!-- Mobiele Navigatie -->
<div class="navbar--mobile">
    <div class="container">
        <div class="navbar--mobile__top">
            <a class="navbar__logo navbar--mobile__logo" href="<?= esc_url( home_url( '/' ) ); ?>">
                <img src="<?=$logo['url']?>" alt="<?=$logo['alt']?>">
            </a>
            <button class="navbar--mobile__close navbar__icon" href="javascript:void(0);">
                <?=$close?>
            </button>
        </div>

        <div class="navbar--mobile__content">
            <div class="navbar--mobile__navigation">
                <?php foreach ($header_links as $link_item) : ?>
                    <?php 
                        $link = $link_item['link']['link']; 
                        $sub_links = $link_item['link']['sub_links'];
                        $has_submenu = !empty($sub_links) ? 'has-submenu' : '';
                    ?>
                    <div class="navbar--mobile__item <?= $has_submenu; ?>">
                        <a href="<?= esc_url($link['url']); ?>" class="navbar--mobile__link" <?= $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                            <?= esc_html($link['title']); ?>
                        </a>
                        <?php if ($sub_links) : ?>
                            <ul class="navbar--mobile__submenu">
                                <?php foreach ($sub_links as $sub_link_item) : ?>
                                    <?php $sub_link = $sub_link_item['sub_link']; ?>
                                    <li class="navbar--mobile__submenu-item">
                                        <a href="<?= esc_url($sub_link['url']); ?>" class="navbar--mobile__submenu-link" <?= $sub_link['target'] ? 'target="' . esc_attr($sub_link['target']) . '"' : ''; ?>>
                                            <?= esc_html($sub_link['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if ($special_link) : ?>
                    <a href="<?= esc_url($special_link['url']); ?>" class="navbar--mobile__link" <?= $special_link['target'] ? 'target="' . esc_attr($special_link['target']) . '"' : ''; ?>>
                        <?= esc_html($special_link['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
