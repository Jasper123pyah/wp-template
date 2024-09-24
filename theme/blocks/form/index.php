<?php
$shortcode      = get_sub_field( 'shortcode' );
$title          = get_sub_field( 'title' );
$form_shortcode = "[wpforms id=" . get_sub_field( 'shortcode' ) . "]";
?>

<div class="form">
	<div class="container">
		<h2 class="form__title">
			<?= $title ?>
		</h2>
		<div class="form__wpform">
			<?= do_shortcode( $form_shortcode ); ?>
		</div>
	</div>
	<div id="flower-form" class="form__flower"></div>
</div>