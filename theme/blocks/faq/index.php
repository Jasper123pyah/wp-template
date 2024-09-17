<?php
$title     = get_sub_field( 'title' );
$accordion = get_sub_field( 'accordion' );

?>

<div class="faq">
	<div id="flower-faq" class="faq__flower"></div>
	<div class="container">
		<h2 class="faq__title"><?= $title ?></h2>
		<div class="faq__container">
			<?php foreach ( $accordion as $key => $item ): ?>
				<div class="faq__content">
					<div class="faq__head">
						<h4 class="faq__head-text">
							<?= $item['title'] ?>
						</h4>
						<img loading="lazy" class="faq__arrow" src="<?= get_template_directory_uri() ?>/assets/images/arrow-down.svg" class="faq__icon" />
					</div>
					<div class="faq__text">
						<?= $item['text'] ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>