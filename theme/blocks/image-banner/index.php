<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$background_image = get_sub_field('image');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
$shade = get_sub_field('image_shade');
$text_color = get_sub_field('text_color');

$banner_class = 'image-banner';
if ($shade) {
    $banner_class .= ' image-banner--shaded';
}
$banner_class .= ' image-banner--text-' . $text_color;
?>

<div class="<?= esc_attr($banner_class); ?>" style="background-image: url('<?= esc_url($background_image['url']); ?>');">
    <div class="image-banner__overlay"></div>
    <div class="container">
        <div class="image-banner__content">
            <?php if ($title): ?>
                <h2 class="image-banner__title"><?= esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if ($subtitle): ?>
                <p class="image-banner__subtitle"><?= esc_html($subtitle); ?></p>
            <?php endif; ?>
            <?php if ($first_button || $second_button): ?>
                <div class="image-banner__buttons">
                    <?php if ($first_button): ?>
                        <a href="<?= esc_url($first_button['url']); ?>" class="button"><?= esc_html($first_button['title']); ?></a>
                    <?php endif; ?>
                    <?php if ($second_button): ?>
                        <a href="<?= esc_url($second_button['url']); ?>" class="button button--outline"><?= esc_html($second_button['title']); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
