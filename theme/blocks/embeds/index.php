<?php
$title    = get_sub_field( 'title' );
$subtitle = get_sub_field( 'sub_title' );
$amount   = get_sub_field( 'amount' );
$embed_1  = get_sub_field( 'embed_1' );
$embed_2  = get_sub_field( 'embed_2' );
?>


<div class="embeds">
	<?php if ( $title ): ?>
		<h2 class="cards__title"><?= esc_html( $title ); ?></h2>
	<?php endif; ?>
	<?php if ( $subtitle ): ?>
		<p class="cards__subtitle"><?= esc_html( $subtitle ); ?></p>
	<?php endif; ?>
	<div class="embeds__wrapper embeds__wrapper--<?php echo esc_attr( $amount ); ?>">
		<div class="embeds__embed">
			<?= $embed_1; ?>
		</div>
		<?php if ( 'two' === $amount && $embed_2 ) : ?>
			<div class="embeds__embed">
				<?= $embed_2; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
