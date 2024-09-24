<?php
$variant = get_sub_field('variant');
$background_color = get_sub_field('background');
$image = get_sub_field('image');
$text = get_sub_field('text');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
$button_class = 'button';
if ($background_color == 'light') {
    $button_class .= ' light-background';
}
?>

<div class="image-text <?= esc_attr($background_color); ?> <?= esc_attr($variant); ?>">
    <div class="image-text__container container">
        <?php if ($variant == 'image_text'): ?>
            <div class="image-text__image">
                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
            </div>
            <div class="image-text__text">
                <?= $text; ?>
                <?php if ($first_button || $second_button): ?>
                    <div class="image-text__buttons">
                        <?php if ($first_button): ?>
                            <a href="<?= esc_url($first_button['url']); ?>"
                                class="<?= esc_attr($button_class); ?>"><?= esc_html($first_button['title']); ?></a>
                        <?php endif; ?>
                        <?php if ($second_button): ?>
                            <a href="<?= esc_url($second_button['url']); ?>"
                                class="<?= esc_attr($button_class); ?> outline"><?= esc_html($second_button['title']); ?></a>
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
                            <a href="<?= esc_url($first_button['url']); ?>"
                                class="<?= esc_attr($button_class); ?>"><?= esc_html($first_button['title']); ?></a>
                        <?php endif; ?>
                        <?php if ($second_button): ?>
                            <a href="<?= esc_url($second_button['url']); ?>"
                                class="<?= esc_attr($button_class); ?> outline"><?= esc_html($second_button['title']); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="image-text__image">
                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>