<?php if ($field == 'translated') : ?>
	<?=
		$this->Element('AdminTheme.Forms/translated_inputs', [
			'inputs' => $options
		]);

	?>
<?php else : ?>

	<?php if (isset($options['element'])) : ?>
		<?=

			$this->Element($options['element'], [
				'entity' => $entity,
				'field' => $field,
				'options' => $options
			]);

		?>
	<?php else : ?>
		<?= $this->Form->control($field, $options); ?>
	<?php endif; ?>

<?php endif; ?>

<?php if (isset($options['unlock'])) : ?>
	<?php $this->Form->unlockField($field); ?>
<?php endif; ?>