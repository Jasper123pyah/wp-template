<?php
$quote = get_sub_field( 'quote' );
?>

<div id="quote" class="quote">
	<div class="container">
		<div class="quote__content">
			<?php if ( $quote ) : ?>
				<div class="quote__text"><?= $quote ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
