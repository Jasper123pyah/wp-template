<?php
$args = [
	'post_type'      => 'reviews',
	'posts_per_page' => 5,
];

$query = new WP_Query( $args );
?>

<div class="reviews">
	<div class="container">
		<div class="reviews__content">
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				<div class="single-review">
					<h4 class="reviews__text">
						<?= get_post_meta(get_the_ID(), 'text', true); ?>
					</h4>
					<div class="reviews-person__container">
						<div class="reviews-person">
							<?= wp_get_attachment_image(
								get_post_meta(get_the_ID(), 'picture', true),
								[160, 160],
								false,
								[
									'class' => 'reviews-person__image',
									'loading' => 'lazy',
								]
							) ?>
							<h3 class="reviews-person__name"><?= get_post_meta(get_the_ID(), 'name', true); ?></h3>
							<div class="reviews-person__function"><?= get_post_meta(get_the_ID(), 'title', true); ?></div>
						</div>
						<div class="reviews__arrows">
							<a class="reviews__arrow reviews__arrow--left"></a>
							<a class="reviews__arrow reviews__arrow--right"></a>
						</div>
					</div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
