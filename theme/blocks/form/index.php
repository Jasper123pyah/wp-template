<?php
$form_id = get_sub_field('form');
$form = get_post($form_id);
$fields = get_field('fields', $form_id);
$title = get_field('title', $form_id);
$subtitle = get_field('subtitle', $form_id);

if ($fields):
	?>
	<div class="form">
		<div class="container">
			<?php if ($title): ?>
				<h2 class="form__title">
					<?= esc_html($title); ?>
				</h2>
			<?php endif; ?>
			<?php if ($subtitle): ?>
				<p class="form__subtitle">
					<?= esc_html($subtitle); ?>
				</p>
			<?php endif; ?>
			<form action="" method="post">
				<?php
				foreach ($fields as $field):
					$field_title = esc_html($field['title']);
					$field_name = sanitize_title($field['title']);
					$field_placeholder = isset($field['placeholder']) ? esc_attr($field['placeholder']) : '';
					$field_required = isset($field['required']) && $field['required'] ? 'required' : '';

					switch ($field['acf_fc_layout']):
						case 'email':
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<input type="email" id="<?= $field_name; ?>" name="<?= $field_name; ?>"
									placeholder="<?= $field_placeholder; ?>" <?= $field_required; ?>>
							</div>
							<?php
							break;
						case 'text':
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<input type="text" id="<?= $field_name; ?>" name="<?= $field_name; ?>"
									placeholder="<?= $field_placeholder; ?>" <?= $field_required; ?>>
							</div>
							<?php
							break;
						case 'textarea':
							$rows = isset($field['rows']) ? intval($field['rows']) : 5;
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<textarea id="<?= $field_name; ?>" name="<?= $field_name; ?>" placeholder="<?= $field_placeholder; ?>"
									rows="<?= $rows; ?>" <?= $field_required; ?>></textarea>
							</div>
							<?php
							break;
						case 'select':
							$choices = explode("\n", $field['choices']);
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<select id="<?= $field_name; ?>" name="<?= $field_name; ?><?= $field['multiple'] ? '[]' : ''; ?>"
									<?= $field['multiple'] ? 'multiple' : ''; ?> 				<?= $field_required; ?>>
									<?php foreach ($choices as $choice): ?>
										<option value="<?= esc_attr(trim($choice)); ?>"><?= esc_html(trim($choice)); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php
							break;
						case 'checkbox':
							$choices = explode("\n", $field['choices']);
							?>
							<div class="form-group">
								<p><?= $field_title; ?></p>
								<?php foreach ($choices as $choice): ?>
									<label>
										<input type="checkbox" name="<?= $field_name; ?>[]" value="<?= esc_attr(trim($choice)); ?>">
										<?= esc_html(trim($choice)); ?>
									</label><br>
								<?php endforeach; ?>
							</div>
							<?php
							break;
						case 'radio':
							$choices = explode("\n", $field['choices']);
							?>
							<div class="form-group">
								<label><?= $field_title; ?></label>
								<?php foreach ($choices as $choice): ?>
									<label>
										<input type="radio" name="<?= $field_name; ?>" value="<?= esc_attr(trim($choice)); ?>">
										<?= esc_html(trim($choice)); ?>
									</label>
								<?php endforeach; ?>
							</div>
							<?php
							break;
						case 'date':
							$date_format = isset($field['date_format']) ? esc_attr($field['date_format']) : 'dd/mm/yyyy';
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<input type="date" id="<?= $field_name; ?>" name="<?= $field_name; ?>"
									placeholder="<?= $field_placeholder; ?>" <?= $field_required; ?>>
							</div>
							<?php
							break;
						case 'number':
							$min = isset($field['min_value']) ? 'min="' . intval($field['min_value']) . '"' : '';
							$max = isset($field['max_value']) ? 'max="' . intval($field['max_value']) . '"' : '';
							?>
							<div class="form-group">
								<label for="<?= $field_name; ?>"><?= $field_title; ?></label>
								<input type="number" id="<?= $field_name; ?>" name="<?= $field_name; ?>"
									placeholder="<?= $field_placeholder; ?>" <?= $min; ?> 				<?= $max; ?> 				<?= $field_required; ?>>
							</div>
							<?php
							break;
					endswitch;
				endforeach;
				?>
				<div class="form-group">
					<input class="button" type="submit" value="Verzenden">
				</div>
			</form>
		</div>
	</div>
	<?php
endif;
?>