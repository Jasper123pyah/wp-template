<?php
$products = get_sub_field( 'products' );
?>

<div class="products">
	<div class="container">
		<div class="products__container">
			<?php $counter = 0; ?>
			<?php foreach ( $products as $product ): ?>
				<div class="products__product">
					<?php if ( $counter % 2 == 0 ): ?>
						<img loading="lazy" src="<?= $product['image']; ?>" class="products__image">
					<?php endif; ?>
					<div class="products__content">
						<img loading="lazy" class="products__icon" src="<?= $product['icon']; ?>">
						<div class="products__text"><?= $product['text']; ?></div>
						<a href="<?= $product['button']['url']; ?>" class="button button--primary products__button">
							<?= $product['button']['title']; ?>
						</a>
					</div>
					<?php if ( $counter % 2 != 0 ): ?>
						<img loading="lazy" src="<?= $product['image']; ?>" class="products__image">
					<?php endif; ?>
				</div>
				<?php $counter ++; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

