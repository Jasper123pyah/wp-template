<?php
// Haal de velden op
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$table = get_sub_field('table');
?>

<div class="container">
    <?php if ($title) : ?>
        <h2 class="table__title"><?= esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($subtitle) : ?>
        <p class="table__subtitle"><?= esc_html($subtitle); ?></h3>
    <?php endif; ?>

    <table class="table">
        <?php if (!empty($table['caption'])) : ?>
            <caption><?= esc_html($table['caption']); ?></caption>
        <?php endif; ?>

        <?php if (!empty($table['header'])) : ?>
            <thead>
                <tr>
                    <?php foreach ($table['header'] as $th) : ?>
                        <th><?= esc_html($th['c']); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php endif; ?>

        <tbody>
            <?php foreach ($table['body'] as $tr) : ?>
                <tr>
                    <?php foreach ($tr as $td) : ?>
                        <td><?= esc_html($td['c']); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
