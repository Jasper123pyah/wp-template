<?php
$variant = get_sub_field('variant');
$image = get_sub_field('image');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
?>

<div class="header header--<?= $variant ?>">
    <?php if ($variant !== 'text_image'): ?>
    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" class="header__image">
    <?php endif; ?>
    <?php if ($variant === 'card'): ?>
        <div class="header__container container">
    <?php endif; ?>
        <div class="header__content">
            <h1 class="header__title"><?= $title ?></h1>
            <?php if ($subtitle): ?>
                <h4 class="header__subtitle"><?= $subtitle ?></h4>
            <?php endif; ?>
            <div class="header__buttons">
                <?php if ($first_button): ?>
                    <a href="<?= $first_button['url'] ?>" class="button <?= $variant === 'text_image' ? 'light-background' : '' ?>"><?= $first_button['title'] ?></a>
                <?php endif; ?>
                <?php if ($second_button): ?>
                    <a href="<?= $second_button['url'] ?>" class="button <?= $variant === 'text_image' ? 'light-background' : '' ?>"><?= $second_button['title'] ?></a>
                <?php endif; ?>
            </div>
        </div>
    <?php if ($variant === 'card'): ?>
        </div>
    <?php endif; ?>
    <?php if ($variant === 'text_image'): ?>
        <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" class="header__image">
    <?php endif; ?>
</div>
