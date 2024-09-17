<?php
$first_text  = get_sub_field( 'first_text' );
$red_block   = get_sub_field( 'red_block' );
$second_text = get_sub_field( 'second_text' );
$button      = get_sub_field( 'button' );
$image       = get_sub_field( 'image' );
?>

<div class="product-detail-description">
	<div class="container">
		<div class="product-detail-description__top">
			<div class="product-detail-description__text">
				<?= $first_text ?>
			</div>
			<div class="product-detail-description__block">
				<?= $red_block ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="product-detail-description__bottom">
			<img loading="lazy" class="product-detail-description__image" src="<?= $image ?>">
			<div id="pdd-second-text" class="product-detail-description__text">
				<?= $second_text ?>
				<a href="<?= $button['url'] ?>" class="button button--outline product-detail-description__button">
					<?= $button['title'] ?>
				</a>
			</div>
		</div>
	</div>
</div>
