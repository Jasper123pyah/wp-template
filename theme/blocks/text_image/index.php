<?php
$text             = get_sub_field( 'text' );
$image            = get_sub_field( 'image' );
$image_width      = get_sub_field( 'image_width' );
$button           = get_sub_field( 'button' );
$image_margin     = get_sub_field( 'image_margin' );
$align_content    = get_sub_field( 'align_content' );
$background_color = get_sub_field( 'background_color' );
?>

<div class="text-image <?= $image_margin ? 'text-image--image_margin' : '' ?>" style="background-color:<?= $background_color ?>">
	<div class="container">
		<div class="text-image__container <?= $align_content ? 'text-image__container--align' : '' ?>">
			<div class="text-image__content">
				<?php if ( $text ): ?>
					<?= $text ?>
				<?php endif; ?>
				<?php if ( $button ): ?>
					<a href="<?= $button['url'] ?>" class="text-image__button button button--outline">
						<?= $button['title'] ?>
					</a>
				<?php endif; ?>
			</div>
			<?php if ( $image ): ?>
				<img loading="lazy" style="width:<?=$image_width?>%" class="text-image__image" src="<?= $image ?>"/>
			<?php endif; ?>
		</div>
	</div>
</div>