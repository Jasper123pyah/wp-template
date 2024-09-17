<?php
$title  = get_sub_field( 'title' );
$list   = get_sub_field( 'list' );
$button = get_sub_field( 'button' );
?>

<div class="golden-list">
	<div class="container">
		<?php if ( $title ): ?>
			<h2 class="golden-list__title">
				<?= $title; ?>
			</h2>
		<?php endif; ?>
		<ul class="golden-list__list">
			<?php foreach ( $list as $item ): ?>
				<li class="golden-list__item">
					<?= $item['point']; ?>
				</li>
			<?php endforeach; ?>
			<?php if ( $button ): ?>
				<a href="<?= $button['url']; ?>" class="button button--white golden-list__button">
					<?= $button['title']; ?>
				</a>
			<?php endif; ?>
		</ul>
	</div>
</div>
