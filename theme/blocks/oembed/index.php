<?php
$embed = get_sub_field( 'embed' );
$align = get_sub_field( 'align' );
$width = get_sub_field( 'width' );
?>

<div class="oembed">
	<div class="container">
		<div class="oembed__wrapper oembed__wrapper--<?=$align?>">
			<div class="oembed__container " style="width:<?=$width?>%">
				<?= $embed ?>
			</div>
		</div>
	</div>
</div>
