<?php if ( have_rows( 'milestones' ) ): ?>
	<div class="three-milestone">
		<div id="flower-tm" class="three-milestone__flower"></div>
		<div class="container">
			<div class="three-milestone__container">
				<?php while ( have_rows( 'milestones' ) ): the_row();
					$icon = get_sub_field( 'icon' );
					$title = get_sub_field( 'title' );
					$paragraph = get_sub_field( 'paragraph' );
					?>
					<div class="three-milestone__content">
						<?php if ( $icon ): ?>
							<img loading="lazy" class="three-milestone__icon" src="<?= $icon ?>"/>
						<?php endif; ?>
						<?php if ( $title ): ?>
							<h2 class="three-milestone__title"><?= $title ?></h2>
						<?php endif; ?>
						<?php if ( $paragraph ): ?>
							<p class="three-milestone__paragraph"><?= $paragraph ?></p>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
