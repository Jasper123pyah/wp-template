<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$media_type = get_sub_field('media_type');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
$shade = get_sub_field('image_shade');
$text_color = get_sub_field('text_color');

$banner_class = 'image-banner';
if ($shade) {
    $banner_class .= ' image-banner--shaded';
}
$banner_class .= " image-banner--text-{$text_color}";

if ($media_type == 'image') {
    $media_url = get_sub_field('image')['url'];
    $media_alt = get_sub_field('image')['alt'];
} elseif ($media_type == 'video') {
    $media_url = get_sub_field('video')['url'];
}
?>

<div class="<?= esc_attr($banner_class); ?>">
    <?php if ($media_url): ?>
        <div class="image-banner__media">
            <?php if ($media_type == 'image'): ?>
                <img src="<?= esc_url($media_url); ?>" alt="<?= esc_attr($media_alt); ?>" class="image-banner__media-element">
            <?php elseif ($media_type == 'video'): ?>
                <video autoplay muted loop class="image-banner__media-element">
                    <source src="<?= esc_url($media_url); ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
    <?php endif; ?>
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
