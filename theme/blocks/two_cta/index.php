<?php
$title = get_sub_field( 'title' );
?>

<?php if ( have_rows( 'ctas' ) ): ?>
	<div class="two-cta">
		<div class="container">
			<h2 class="two-cta__top-title">
				<?= $title?>
			</h2>
			<div class="two-cta__container">
				<?php while ( have_rows( 'ctas' ) ): the_row();
					$icon = get_sub_field( 'icon' );
					$title = get_sub_field( 'title' );
					$paragraph = get_sub_field( 'text' );
					$button = get_sub_field( 'button' );
					?>
					<div class="two-cta__content">
						<?php if ( $icon ): ?>
							<img loading="lazy" class="two-cta__icon" src="<?= $icon ?>"/>
						<?php endif; ?>
						<?php if ( $title ): ?>
							<h3 class="two-cta__title"><?= $title ?></h3>
						<?php endif; ?>
						<?php if ( $paragraph ): ?>
							<p class="two-cta__paragraph"><?= $paragraph ?></p>
						<?php endif; ?>
						<?php if ( $button ): ?>
							<a href="<?= $button['url'] ?>" class="button button--primary two-cta__link"><?= $button['title'] ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
