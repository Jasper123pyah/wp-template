<?php
$image = get_sub_field( 'image' );
$title = get_sub_field( 'title' );
$list  = get_sub_field( 'list' );
?>

<div class="header-product-overview">
	<img class="header-product-overview__image" src="<?= $image?>" />
	<div class="container">
		<div class="header-product-overview__container">
			<div class="header-product-overview__content">
			<h1 class="header-product-overview__title">
				<?= $title ?>
			</h1>
			<ul class="header-product-overview__list">
				<?php foreach ( $list as $item ): ?>
					<li class="header-product-overview__item">
						<?= $item['point'] ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		</div>
	</div>


</div>
