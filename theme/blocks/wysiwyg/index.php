<?php
$editor = get_sub_field( 'editor' );
$align = get_sub_field( 'align' );
$width = get_sub_field( 'width' );
?>

<div class="editor">
	<div class="container">
		<div class="editor__wrapper editor__wrapper--<?=$align?>">
			<div class="editor__container " style="width:<?=$width?>%">
				<?= $editor ?>
			</div>
		</div>
	</div>
</div>
