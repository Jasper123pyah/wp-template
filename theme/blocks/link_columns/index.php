<?php
$title            = get_sub_field( 'title' );
$columns          = get_sub_field( 'columns' );
$background_color = get_sub_field( 'background_color' );
$columns_count    = count( $columns );

?>

<div id="link_columns" class="link_columns" style="background-color: <?= $background_color ?>">
	<div class="container">
		<?php if ( $title ): ?>
			<div class="link_columns__title"><?= $title ?></div>
		<?php endif; ?>

		<div class="link_columns__columns columns-<?= $columns_count ?>">
			<?php foreach ( $columns as $column ): ?>
				<div class="link_columns__column">
					<?php if ( $column['title'] ): ?>
						<div class="link_columns__column-title"><?= $column['title'] ?></div>
					<?php endif; ?>
					<?php foreach ( $column['links'] as $link ): ?>
						<a class="link_columns__link" href="<?= $link['link']['url'] ?>" target="<?= $link['link']['target'] ?>"><?= $link['link']['title'] ?></a>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
