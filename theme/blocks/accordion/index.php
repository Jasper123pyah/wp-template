<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$rows = get_sub_field('rows');
$variant = get_sub_field('variant');
?>

<div class="accordion <?= esc_attr($variant); ?>">
    <div class="container">
        <?php if ($title): ?>
            <h2 class="accordion__title"><?= esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($subtitle): ?>
            <p class="accordion__subtitle"><?= esc_html($subtitle); ?></p>
        <?php endif; ?>

        <?php if ($rows): ?>
            <div class="accordion__items">
                <?php foreach ($rows as $index => $row): ?>
                    <div class="accordion__item" data-index="<?= $index ?>">
                        <h5 class="accordion__toggle">
                            <?= esc_html($row['title']); ?>
                        </h5>
                        <div class="accordion__content">
                            <p><?= esc_html($row['content']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>