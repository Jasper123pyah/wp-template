<?php
$pictures = get_sub_field( 'pictures' );
?>

<div class="pictures container">
	<div class="pictures__wrapper">
		<?php foreach ( $pictures as $picture ): ?>
		<div class="pictures__picture-wrapper">
			<img loading="lazy" style="width:<?=$picture['width']?>%" class="pictures__picture" src="<?=$picture['image']?>"/>
		</div>
		<?php endforeach; ?>
	</div>
</div>
