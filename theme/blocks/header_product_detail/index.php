<?php
$image = get_sub_field( 'image' );
$text  = get_sub_field( 'text' );
?>

<div class="header-product-detail">
	<img class="header-product-detail__image" src="<?= $image ?>"/>
	<div class="container">
		<div class="header-product-detail__container">
			<div class="header-product-detail__content">
				<?= $text ?>
			</div>
		</div>
	</div>
</div>
