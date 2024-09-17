<?php if ( have_rows( 'ctas' ) ): ?>
	<div class="three-cta">
		<div id="flower-tcta" class="three-cta__flower"></div>
		<div class="container">
			<div class="three-cta__container">
				<?php while ( have_rows( 'ctas' ) ): the_row();
					$icon = get_sub_field( 'icon' );
					$title = get_sub_field( 'title' );
					$paragraph = get_sub_field( 'paragraph' );
					$button = get_sub_field( 'button' );
					?>
					<div class="three-cta__content">
						<div class="three-cta__head">
							<?php if ( $icon ): ?>
								<img loading="lazy" class="three-cta__icon" src="<?= $icon ?>"/>
							<?php endif; ?>
							<?php if ( $title ): ?>
								<h2 class="three-cta__title"><?= $title ?></h2>
							<?php endif; ?>
						</div>

						<?php if ( $paragraph ): ?>
							<p class="three-cta__paragraph"><?= $paragraph ?></p>
						<?php endif; ?>
						<?php if ( $button ): ?>
							<a href="<?= $button['url'] ?>" class="button button--primary three-cta__link"><?= $button['title'] ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( have_rows( 'ctas' ) ): ?>
	<div class="three-cta--mobile">
		<div id="flower-tcta" class="three-cta__flower"></div>
			<div class="three-cta__container">
				<?php while ( have_rows( 'ctas' ) ): the_row();
					$icon = get_sub_field( 'icon' );
					$title = get_sub_field( 'title' );
					$paragraph = get_sub_field( 'paragraph' );
					$button = get_sub_field( 'button' );
					?>
					<div class="three-cta__content">
						<div class="container">
							<div class="three-cta__head">
								<?php if ( $icon ): ?>
									<img loading="lazy" class="three-cta__icon" src="<?= $icon ?>"/>
								<?php endif; ?>
								<?php if ( $title ): ?>
									<h2 class="three-cta__title"><?= $title ?></h2>
								<?php endif; ?>
							</div>

							<?php if ( $paragraph ): ?>
								<p class="three-cta__paragraph"><?= $paragraph ?></p>
							<?php endif; ?>
							<?php if ( $button ): ?>
								<a href="<?= $button['url'] ?>" class="button button--primary three-cta__link"><?= $button['title'] ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

