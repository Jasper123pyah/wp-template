<?php
$variant = get_sub_field('variant');
$background = get_sub_field('background');
$alignment = get_sub_field('alignment');
$container_options = get_sub_field('container_options');
$carousel_columns = get_sub_field('carousel_columns');
$cards = get_sub_field('cards');
?>

<div class="cards__container <?= esc_attr($background); ?> <?= esc_attr($alignment); ?> <?= esc_attr($container_options); ?>">
    <div class="container">
        <?php if ($container_options === 'carousel'): ?>
		<div class="swiper">
			<div class="swiper-wrapper">
        <?php endif; ?>

        <?php if ($cards): ?>
            <?php foreach ($cards as $card): ?>
                <?php
                $card_title = $card['title'];
                $card_variant = $variant;

                if ($card_variant === 'review') {
                    $review_icon = $card['review_icon'];
                    $review_stars = $card['review_stars'];
                    $text = $card['text'];
                    $reviewer_image = $card['reviewer_image'];
                    $reviewer_name = $card['reviewer_name'];
                    $review_date = $card['review_date'];
                } elseif ($card_variant === 'image') {
                    $image = $card['image'];
                    $subtitle = $card['subtitle'];
                    $first_button = $card['first_button'];
                    $second_button = $card['second_button'];
                } elseif ($card_variant === 'icon') {
                    $icon = $card['icon'];
                    $subtitle = $card['subtitle'];
                    $first_button = $card['first_button'];
                    $second_button = $card['second_button'];
                }
                ?>
                <div class="card <?= esc_attr($card_variant); ?>">
                    <?php if ($card_variant === 'review'): ?>
                        <div class="card__review-stars">
                            <?php for ($i = 0; $i < $review_stars; $i++): ?>
                                <?= $review_icon; ?>
                            <?php endfor; ?>
                        </div>
                        <h3 class="card__title"><?= esc_html($card_title); ?></h3>
                        <p class="card__text"><?= esc_html($text); ?></p>
                        <div class="card__reviewer-info">
                            <?php if ($reviewer_image): ?>
                                <div class="card__reviewer-image">
                                    <?= wp_get_attachment_image($reviewer_image['ID'], 'thumbnail'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($reviewer_name): ?>
                                <span class="card__reviewer-name"><?= esc_html($reviewer_name); ?></span>
                            <?php endif; ?>
                            <?php if ($review_date): ?>
                                <span class="card__review-date"><?= esc_html($review_date); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php elseif ($card_variant === 'image'): ?>
                        <?php if ($image): ?>
                            <div class="card__image">
                                <?= wp_get_attachment_image($image['ID'], 'medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h4 class="card__title"><?= esc_html($card_title); ?></h4>
                        <?php if ($subtitle): ?>
                            <h5 class="card__subtitle"><?= esc_html($subtitle); ?></h5>
                        <?php endif; ?>
                        <?php if ($first_button || $second_button): ?>
                            <div class="card__buttons">
                                <?php if ($first_button): ?>
                                    <a href="<?= esc_url($first_button['url']); ?>" class="button"><?= esc_html($first_button['title']); ?></a>
                                <?php endif; ?>
                                <?php if ($second_button): ?>
                                    <a href="<?= esc_url($second_button['url']); ?>" class="button secondary"><?= esc_html($second_button['title']); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($card_variant === 'icon'): ?>
                        <div class="card__icon">
                            <?= $icon; ?>
                        </div>
                        <h3 class="card__title"><?= esc_html($card_title); ?></h3>
                        <?php if ($subtitle): ?>
                            <h4 class="card__subtitle"><?= esc_html($subtitle); ?></h4>
                        <?php endif; ?>
                        <?php if ($first_button || $second_button): ?>
                            <div class="card__buttons">
                                <?php if ($first_button): ?>
                                    <a href="<?= esc_url($first_button['url']); ?>" class="button"><?= esc_html($first_button['title']); ?></a>
                                <?php endif; ?>
                                <?php if ($second_button): ?>
                                    <a href="<?= esc_url($second_button['url']); ?>" class="button secondary"><?= esc_html($second_button['title']); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($container_options === 'carousel'): ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
