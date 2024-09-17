<?php
$title         = get_sub_field( 'title' );
$subtitle      = get_sub_field( 'subtitle' );
$image         = get_sub_field( 'image' );
$button        = get_sub_field( 'button' );
$with_gradient = get_sub_field( 'with_gradient' );
$with_margin   = get_sub_field( 'with_margin' );
?>

<div class="image-banner <?= $with_gradient ? 'image-banner--with_gradient' : '' ?> <?= $with_margin ? 'image-banner--with_margin' : '' ?>">
	<div class="image-banner__image-container">
		<?php if ( $image ) : ?>
			<img loading="lazy" class='image-banner__image' src="<?= $image ?>"/>
		<?php endif; ?>
		<div class='container'>
			<div class="image-banner__content">
				<?php if ( $title ) : ?>
					<h2 class="image-banner__title"><?= $title ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<h3 class="image-banner__subtitle"><?= $subtitle ?></h3>
				<?php endif; ?>
				<?php if ( $button ) : ?>
					<a href="<?= $button['url'] ?>" class="image-banner__button button button--outline"><?= $button['title'] ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
