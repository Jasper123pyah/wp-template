<?php
$variant = get_sub_field('variant');
$background = get_sub_field('background');
$background_cards = get_sub_field('background_cards');
$review_icon = get_sub_field('review_icon');
$alignment = get_sub_field('alignment');
$container_options = get_sub_field('container_options');
$carousel_columns = get_sub_field('carousel_columns');
$cards = get_sub_field('cards');
?>

<div class="cards <?= esc_attr($background); ?> <?= esc_attr($container_options); ?>" data-carousel-columns="<?= esc_attr($carousel_columns); ?>">
    <div class="container">
        <?php if ($container_options === 'carousel'): ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                <?php else: ?>
                    <div class="<?= esc_attr($container_options); ?>">
                    <?php endif; ?>

                    <?php if ($cards): ?>
                        <?php foreach ($cards as $card): ?>
                            <?php
                            $card_title = $card['title'];
                            $card_variant = $variant;
                            $subtitle = $card['subtitle'];
                            $first_button = $card['first_button'];
                            $second_button = $card['second_button'];

                            if ($card_variant === 'review') {
                                $review_stars = $card['review_stars'];
                                $text = $card['text'];
                                $reviewer_image = $card['reviewer_image'];
                                $reviewer_name = $card['reviewer_name'];
                                $review_date = $card['review_date'];
                            } elseif ($card_variant === 'image') {
                                $image = $card['image'];
                            } elseif ($card_variant === 'icon') {
                                $icon = $card['icon'];
                            }
                            ?>

                            <?php if ($container_options === 'carousel'): ?>
                                <div class="swiper-slide">
                                <?php endif; ?>
                                <div
                                    class="card <?= esc_attr($card_variant); ?> <?= esc_attr($background_cards); ?> <?= esc_attr($alignment); ?>">
                                    <?php if ($card_variant === 'review'): ?>
                                        <div class="card__stars">
                                            <?php for ($i = 0; $i < $review_stars; $i++): ?>
                                                <?= $review_icon; ?>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="card__review">
                                            <?php if ($card_title): ?>
                                                <h4 class="card__title"><?= esc_html($card_title); ?></h4>
                                            <?php endif; ?>
                                            <?php if ($text): ?>
                                                <p class="card__subtitle"><?= esc_html($text); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card__reviewer-info">
                                            <?php if ($reviewer_image): ?>
                                                <div class="card__reviewer-image">
                                                    <?= wp_get_attachment_image($reviewer_image['ID'], 'thumbnail'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($reviewer_name || $review_date): ?>
                                                <div class="card__reviewer-details">
                                                    <?php if ($reviewer_name): ?>
                                                        <span class="card__reviewer-name"><?= esc_html($reviewer_name); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($review_date): ?>
                                                        <span class="card__review-date"><?= esc_html($review_date); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <?php if ($card_variant === 'image' && $image): ?>
                                            <div class="card__image">
                                                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
                                            </div>
                                        <?php elseif ($card_variant === 'icon'): ?>
                                            <div class="card__icon">
                                                <?= $icon; ?>
                                            </div>
                                        <?php endif; ?>
                                        <h4 class="card__title"><?= esc_html($card_title); ?></h4>
                                        <?php if ($subtitle): ?>
                                            <p class="card__subtitle"><?= esc_html($subtitle); ?></p>
                                        <?php endif; ?>
                                        <?php if ($first_button || $second_button): ?>
                                            <div class="card__buttons">
                                                <?php if ($first_button): ?>
                                                    <a href="<?= esc_url($first_button['url']); ?>"
                                                        class="button"><?= esc_html($first_button['title']); ?></a>
                                                <?php endif; ?>
                                                <?php if ($second_button): ?>
                                                    <a href="<?= esc_url($second_button['url']); ?>"
                                                        class="button secondary"><?= esc_html($second_button['title']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if ($container_options === 'carousel'): ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ($container_options === 'carousel'): ?>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            <?php else: ?>
            </div>
        <?php endif; ?>
    </div>
</div>