<?php
$image  = get_sub_field( 'image' );
$text   = get_sub_field( 'text' );
$button = get_sub_field( 'button' );
?>

<div class="header-about">
	<img class="header-about__image" src="<?= $image ?>"/>
	<div class="container">
		<div class="header-about__content">
			<?= $text ?>
			<a href="<?= $button['url'] ?>" class="button button--outline">
				<?= $button['title'] ?>
			</a>
		</div>
	</div>
</div>
