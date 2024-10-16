<?php
$variant = get_sub_field('variant');
$media_type = get_sub_field('media_type');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');

if ($media_type == 'image') {
    $image_url = get_sub_field('image')['url'];
} elseif ($media_type == 'video') {
    $image_url = get_sub_field('video')['url'];
}
?>

<div class="header header--<?= esc_attr($variant) ?>">
    <?php if ($image_url): ?>
        <?php if ($variant !== 'text_image'): ?>
            <?php if ($media_type == 'image'): ?>
                <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($title) ?>" class="header__media">
            <?php elseif ($media_type == 'video'): ?>
                <video autoplay muted loop class="header__media">
                    <source src="<?= esc_url($image_url) ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($variant === 'card'): ?>
        <div class="header__container container">
    <?php endif; ?>
        <div class="header__content">
            <h1 class="header__title"><?= esc_html($title) ?></h1>
            <?php if ($subtitle): ?>
                <h4 class="header__subtitle"><?= esc_html($subtitle) ?></h4>
            <?php endif; ?>
            <div class="header__buttons">
                <?php if ($first_button): ?>
                    <a href="<?= esc_url($first_button['url']) ?>" class="button <?= $variant === 'text_image' ? 'light-background' : '' ?>"><?= esc_html($first_button['title']) ?></a>
                <?php endif; ?>
                <?php if ($second_button): ?>
                    <a href="<?= esc_url($second_button['url']) ?>" class="button <?= $variant === 'text_image' ? 'light-background' : '' ?>"><?= esc_html($second_button['title']) ?></a>
                <?php endif; ?>
            </div>
        </div>
    <?php if ($variant === 'card'): ?>
        </div>
    <?php endif; ?>

    <?php if ($variant === 'text_image'): ?>
        <?php if ($image_url): ?>
            <?php if ($media_type == 'image'): ?>
                <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($title) ?>" class="header__media">
            <?php elseif ($media_type == 'video'): ?>
                <video autoplay muted loop class="header__media">
                    <source src="<?= esc_url($image_url) ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
