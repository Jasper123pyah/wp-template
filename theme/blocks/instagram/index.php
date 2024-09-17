<?php
$shortcode = get_sub_field( 'shortcode' );
?>

<div class="instagram">
	<div class="container">
		<?php echo do_shortcode( "[instagram-feed feed=$shortcode]"); ?>
	</div>
</div>
