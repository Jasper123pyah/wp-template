<?php
$image            = get_sub_field( 'image' );
$title            = get_sub_field( 'title' );
$icon_align       = get_sub_field( 'icon_align' );
$sections         = get_sub_field( 'sections' );
$background_color = get_sub_field( 'background_color' );

?>

<div id="icon_columns" class="icon_columns" style="background-color: <?=$background_color?>">
	<div class="container">
		<div class="icon_columns-head">
			<?php if ( $image ) : ?>
				<div class="icon_columns-head__image">
					<img loading="lazy" src="<?= $image; ?>"/>
				</div>
			<?php endif; ?>
			<?php if ( $title ) : ?>
				<div class="icon_columns-head__title">
					<?= $title; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="icon_columns-section">
			<?php if ( $sections ) : ?>
				<?php foreach ( $sections as $section ) : ?>
					<?php
					$section_title = $section['title'];
					$columns       = $section['columns'];
					$sub_blocks    = $section['sub_blocks'];
					?>
					<div class="icon_columns-section__title">
						<?= $section_title ?>
					</div>
					<div class="icon_columns-section__wrapper icon_columns-section__wrapper--<?= $columns ?>">
						<?php foreach ( $sub_blocks as $sub_block ) : ?>
							<?php
							$icon = $sub_block['icon'];
							$text = $sub_block['text'];
							?>
							<div class="icon_columns-subblock">
								<div class="icon_columns-subblock__icon icon_columns-subblock__icon--<?= $icon_align ?>">
									<img loading="lazy" src="<?= $icon; ?>"/>
								</div>
								<div class="icon_columns-subblock__text">
									<?= $text; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
