<?php
$review = get_sub_field( 'review' )->ID;
$align  = get_sub_field( 'align' );
?>

<div class="review-single <?= $align === 'right' ? 'review-single--right' : '' ?>">
	<div class="container">
		<div class="review-single__content">
				<div class="review-single__container">
					<h4 class="review-single__text">
						<?= get_post_meta( $review, 'text', true ); ?>
					</h4>
					<div class="review-single-person__container">
						<div class="review-single-person">
							<?= wp_get_attachment_image(
								get_post_meta( $review, 'picture', true ),
								'full',
								false,
								[
									'class' => 'review-single-person__image',
								]
							) ?>
							<h3 class="review-single-person__name"><?= get_post_meta( $review, 'name', true ); ?></h3>
							<div class="review-single-person__function"><?= get_post_meta( $review, 'title', true ); ?></div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
