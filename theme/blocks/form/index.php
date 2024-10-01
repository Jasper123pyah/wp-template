<?php
$form_id = get_sub_field('form');
$form = get_post($form_id);
?>

<div class="form">
	<div class="container">
		<h2 class="form__title">
			<?= $form->post_title ?>
		</h2>
		<p class="form__subtitle">
			<?= $subtitle ?>
		</p>
	</div>
</div>