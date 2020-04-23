<fieldset class="form__sub-container <?php if (!empty($fieldset['class'])) echo $fieldset['class']; ?>">
	<?php if (!empty($fieldset['legend'])) : ?>
		<legend><?= $fieldset['legend'] ?></legend>
	<?php endif; ?>
	<?php foreach ($fieldset['controls'] as $field => $options) : ?>

		<?=
			$this->Element('AdminTheme.Forms/form_control', [
				'entity' => $entity,
				'field' => $field,
				'options' => $options
			]);
		?>

	<?php endforeach; ?>
</fieldset>