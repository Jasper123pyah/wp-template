<?php
$image     = get_sub_field( 'image' );
$text     = get_sub_field( 'text' );
$button    = get_sub_field( 'button' );
?>

<div class="header-home">
	<?php if ( $image ): ?>
		<img class="header-home__image" src="<?= $image ?>"/>
	<?php endif; ?>
	<div class="container">
		<div class="header-home__content-container">
			<div class="header-home__content">
				<?php if ( $text ): ?>
					<div class="header-home__text"
					><?= $text ?>
					</div>
				<?php endif; ?>
				<?php if ( $button ): ?>
					<a href="<?= $button['url'] ?>" class="image-banner__button button button--primary"><?= $button['title'] ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
