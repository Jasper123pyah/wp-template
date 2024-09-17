<?php
$image         = get_sub_field( 'image' );
$text          = get_sub_field( 'text' );
$button        = get_sub_field( 'button' );
$align_content = get_sub_field( 'align_content' );
$color         = get_sub_field( 'color' );
?>

<div class="image-text-pink image-text-pink--<?=$color?>">
	<div class="container">
		<div class="image-text-pink__container">
			<?php if ( $image ) : ?>
				<img loading="lazy" class="image-text-pink__image" src="<?= $image ?>">
			<?php endif; ?>
			<div class="image-text-pink__content <?= $align_content ? 'image-text-pink__content--align' : '' ?>">
				<?php if ( $text ) : ?>
					<?= $text ?>
				<?php endif; ?>
				<?php if ( $button ) : ?>
					<a href="<?= $button['url'] ?>" class="button button--outline image-text-pink__button">
						<?= $button['title'] ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<div id="itp-rectangle" class="image-text-pink__rectangle image-text-pink__rectangle--<?=$color?>"></div>
	</div>
</div>
