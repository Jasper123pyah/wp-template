<?php
$image            = get_sub_field( 'image' );
$image_width      = get_sub_field( 'image_width' );
$text             = get_sub_field( 'text' );
$button           = get_sub_field( 'button' );
$button_color     = get_sub_field( 'button_color' );
$image_margin     = get_sub_field( 'image_margin' );
$align_content    = get_sub_field( 'align_content' );
$background_color = get_sub_field( 'background_color' );
?>

<div class="image-text <?= $image_margin ? 'image-text--image_margin' : '' ?>" style="background-color:<?=$background_color?>" >
	<div class='container'>
		<div class="image-text__container <?= $align_content ? 'image-text__container--align' : '' ?>">
			<div class="image-text__image-container">
				<?php if ( $image ) : ?>
					<img loading="lazy" style="width: <?=$image_width?>%" class='image-text__image' src="<?= $image ?>"/>
				<?php endif; ?>
			</div>
			<div class="image-text__content">
				<?php if ( $text ) : ?>
					<?= $text ?>
				<?php endif; ?>
				<?php if ( $button ) : ?>
					<a href="<?= $button['url'] ?>" class="image-text__button button button--<?= $button_color ?>"><?= $button['title'] ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
