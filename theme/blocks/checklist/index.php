<?php
$image     = get_sub_field( 'image' );
$text      = get_sub_field( 'text' );
$button    = get_sub_field( 'button' );
$quote     = get_sub_field( 'quote' );
$checklist = get_sub_field( 'checklist' );

?>

<div class="checklist">
	<div class="checklist__container">
		<div class="container">
			<div class="checklist__top">
				<?php if ( $image ) : ?>
					<div class="checklist__image-container">
						<img loading="lazy" class='checklist__image' src="<?= $image ?>"/>
					</div>
				<?php endif; ?>
				<?php if ( $text ) : ?>
					<div class="checklist__text"><?= $text ?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="checklist__bottom">
			<div class="container">
				<div class="checklist__bottom-container">
					<div class="checklist__bottom-left">
						<?php if ( $quote ) : ?>
							<h2 class="checklist__quote"><?= $quote ?></h2>
						<?php endif; ?>
						<?php if ( $button ) : ?>
							<a href="<?= $button['url'] ?>" class="checklist__cta button button--primary"><?= $button['title'] ?></a>
						<?php endif; ?>
					</div>
					<ul class="checklist__list">
						<?php while ( have_rows( 'checklist' ) ): the_row();
							$text = get_sub_field( 'text' );
							?>
							<li class="checklist__item"><?= $text ?></li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
