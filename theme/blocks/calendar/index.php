<?php
$calendar       = get_sub_field( 'calendly' ); // ACF oEmbed field
$text           = get_sub_field( 'text' );

?>

<div class="calendar">
	<div class="container">
		<div class="calendar__container">
			<div class="calendar__text">
				<?php if ( $text ): ?>
					<?= $text ?>
				<?php endif; ?>
			</div>
			<div class="calendar__embed">
				<iframe src="<?= $calendar ?>" width="100%" height="100%" frameborder="0" title="Select a Date &amp; Time - Calendly"></iframe>
			</div>
		</div>
	</div>
</div>
