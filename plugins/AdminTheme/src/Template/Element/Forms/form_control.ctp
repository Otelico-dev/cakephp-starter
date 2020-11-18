<?php

use Cake\Utility\Inflector;
?>

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

		<?php

		if (isset($options['rich_text'])) {
			$this->Html->scriptStart(['block' => true]);
			echo $this->CkEditor->getJavascript(Inflector::dasherize($field));
			$this->Html->scriptEnd();
		}
		?>

	<?php endif; ?>

<?php endif; ?>

<?php if (isset($options['unlock'])) : ?>
	<?php $this->Form->unlockField($field); ?>
<?php endif; ?>