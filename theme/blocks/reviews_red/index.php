<?php
$args = [
	'post_type'      => 'reviews',
	'posts_per_page' => 15,
];

$query = new WP_Query( $args );
?>

<div class="reviews-red">
	<div class="container">
		<h2 class="reviews-red__title">
			Reviews
		</h2>
		<a class="reviews-red__arrow reviews-red__arrow--left"></a>
		<a class="reviews-red__arrow reviews-red__arrow--right"></a>
		<div class="reviews-red__overlay"></div>
		<div class="reviews-red__modal" id="dynamicModal">
			<div class="reviews-red__modal-head">
				<h3 class="reviews-red__modal-head-title" id="modalTitle"></h3>
				<a class="reviews-red__close-modal">
					<img loading="lazy" src="<?= get_template_directory_uri() ?>/assets/images/close.svg" alt="close">
				</a>
			</div>
			<div class="reviews-red__modal-body" id="modalBody">
			</div>
		</div>
		<div class="reviews-red__content">
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$stars_value             = get_post_meta( get_the_ID(), 'stars', true );
				$full_stars              = floor( $stars_value / 10 );
				$partial_star_percentage = ( $stars_value % 10 ) * 10;
				?>
				<div class="reviews-red-single">
					<div class="reviews-red-single__head">
						<h4 class="reviews-red__name">
							<?= get_post_meta( get_the_ID(), 'name', true ); ?>
						</h4>
						<div class="reviews-red__stars">
							<?php
							for ( $i = 0; $i < $full_stars; $i ++ ) {
								echo '<img loading="lazy" class="full-star" src="' . get_template_directory_uri() . '/assets/images/star.svg" alt="star">';
							}
							if ( $partial_star_percentage > 0 ) {
								echo '<div class="partial-star" data-percentage="' . $partial_star_percentage . '" style="background-image: url(' . get_template_directory_uri() . '/assets/images/star.svg);"></div>';
							}
							?>
						</div>
					</div>
					<div class="reviews-red__text">
						<?= get_post_meta( get_the_ID(), 'text', true ); ?>
					</div>
					<a class="reviews-red__open-modal" data-id="<?= get_the_ID(); ?>">
						Lees meer...
					</a>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>