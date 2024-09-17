<?php
$image  = get_sub_field( 'image' );
$button = get_sub_field( 'button' );
$text   = get_sub_field( 'text' );
$color  = get_sub_field( 'color' )
?>

<div class="text-image-pink text-image-pink--<?=$color?>">
	<div class="container">
		<div id="tip-rectangle" class="text-image-pink__rectangle text-image-pink__rectangle--<?=$color?>"></div>
		<?php if ( $image ) : ?>
			<img loading="lazy" class="text-image-pink__image" src="<?= $image ?>">
		<?php endif; ?>

		<div id="tip-rectangle-content" class="text-image-pink__content">
			<?php if ( $text ) : ?>
				<?= $text ?>
			<?php endif; ?>
		</div>
		<?php if ( $button ) : ?>
			<a href="<?= $button['url'] ?>" class="text-image-pink__cta button button--outline"><?= $button['title'] ?></a>
		<?php endif; ?>
	</div>

</div>
