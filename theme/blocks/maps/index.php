<?php
$layout = get_sub_field('layout');
$google_map = get_sub_field('google_map');
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$text = get_sub_field('text');
$first_button = get_sub_field('first_button');
$second_button = get_sub_field('second_button');
?>

<div class="maps-block <?= esc_attr($layout); ?>">
	<div class="maps-block__container container">
		<?php if ($layout == 'left'): ?>
			<?php if ($google_map): ?>
				<div class="maps-block__map">
					<div class="acf-map">
						<div class="marker" data-lat="<?= esc_attr($google_map['lat']); ?>" data-lng="<?= esc_attr($google_map['lng']); ?>"></div>
					</div>
				</div>
			<?php endif; ?>
			<div class="maps-block__text">
				<?php if ($title): ?>
					<h2><?= esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($sub_title): ?>
					<h3><?= esc_html($sub_title); ?></h3>
				<?php endif; ?>
				<?= $text; ?>
				<?php if ($first_button || $second_button): ?>
					<div class="maps-block__buttons">
						<?php if ($first_button): ?>
							<a href="<?= esc_url($first_button['url']); ?>" class="button"><?= esc_html($first_button['title']); ?></a>
						<?php endif; ?>
						<?php if ($second_button): ?>
							<a href="<?= esc_url($second_button['url']); ?>" class="button outline"><?= esc_html($second_button['title']); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php elseif ($layout == 'right'): ?>
			<div class="maps-block__text">
				<?php if ($title): ?>
					<h2><?= esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($sub_title): ?>
					<h3><?= esc_html($sub_title); ?></h3>
				<?php endif; ?>
				<?= $text; ?>
				<?php if ($first_button || $second_button): ?>
					<div class="maps-block__buttons">
						<?php if ($first_button): ?>
							<a href="<?= esc_url($first_button['url']); ?>" class="button"><?= esc_html($first_button['title']); ?></a>
						<?php endif; ?>
						<?php if ($second_button): ?>
							<a href="<?= esc_url($second_button['url']); ?>" class="button outline"><?= esc_html($second_button['title']); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ($google_map): ?>
				<div class="maps-block__map">
					<div class="acf-map">
						<div class="marker" data-lat="<?= esc_attr($google_map['lat']); ?>" data-lng="<?= esc_attr($google_map['lng']); ?>"></div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>