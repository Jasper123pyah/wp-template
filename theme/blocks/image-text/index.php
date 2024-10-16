<?php
$variant = get_sub_field('variant');
$background_color = get_sub_field('background');
$media_type = get_sub_field('media_type');
$text = get_sub_field('text');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
$button_class = 'button';
if ($background_color == 'light') {
    $button_class .= ' light-background';
}

if ($media_type == 'image') {
    $media_url = get_sub_field('image')['url'];
    $media_alt = get_sub_field('image')['alt'];
} elseif ($media_type == 'video') {
    $media_url = get_sub_field('video')['url'];
}
?>

<div class="image-text <?= esc_attr($background_color); ?> <?= esc_attr($variant); ?>">
    <div class="image-text__container container">
        <?php if ($variant == 'image_text'): ?>
            <?php if ($media_url): ?>
                <div class="image-text__media">
                    <?php if ($media_type == 'image'): ?>
                        <img src="<?= esc_url($media_url); ?>" alt="<?= esc_attr($media_alt); ?>" class="image-text__media-element">
                    <?php elseif ($media_type == 'video'): ?>
                        <video autoplay muted loop class="image-text__media-element">
                            <source src="<?= esc_url($media_url); ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="image-text__text">
                <?= $text; ?>
                <?php if ($first_button || $second_button): ?>
                    <div class="image-text__buttons">
                        <?php if ($first_button): ?>
                            <a href="<?= esc_url($first_button['url']); ?>" class="<?= esc_attr($button_class); ?>"><?= esc_html($first_button['title']); ?></a>
                        <?php endif; ?>
                        <?php if ($second_button): ?>
                            <a href="<?= esc_url($second_button['url']); ?>" class="<?= esc_attr($button_class); ?> outline"><?= esc_html($second_button['title']); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php elseif ($variant == 'text_image'): ?>
            <div class="image-text__text">
                <?= $text; ?>
                <?php if ($first_button || $second_button): ?>
                    <div class="image-text__buttons">
                        <?php if ($first_button): ?>
                            <a href="<?= esc_url($first_button['url']); ?>" class="<?= esc_attr($button_class); ?>"><?= esc_html($first_button['title']); ?></a>
                        <?php endif; ?>
                        <?php if ($second_button): ?>
                            <a href="<?= esc_url($second_button['url']); ?>" class="<?= esc_attr($button_class); ?> outline"><?= esc_html($second_button['title']); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($media_url): ?>
                <div class="image-text__media">
                    <?php if ($media_type == 'image'): ?>
                        <img src="<?= esc_url($media_url); ?>" alt="<?= esc_attr($media_alt); ?>" class="image-text__media-element">
                    <?php elseif ($media_type == 'video'): ?>
                        <video autoplay muted loop class="image-text__media-element">
                            <source src="<?= esc_url($media_url); ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
