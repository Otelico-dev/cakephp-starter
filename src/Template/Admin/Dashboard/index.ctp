<?php $this->extend('AdminTheme./Common/form'); ?>
<?php $this->assign('entity', null); ?>

<?php $this->start('form.controls'); ?>
<?= $this->Form->control('date', ['type' => 'datepicker', 'value' => new \DateTime()]) ?>
<?=
	$this->Form->control(
		'select',
		[
			'label' => 'Select',
			'type' => 'select',
			'options' => [
				'yes' => 'Yes',
				'no' => 'No',
				'maybe' => 'Maybe'
			],
			'empty' => '(choose one)',
			'placeholder' => 'select an option'
		]
	);
?>
<?= $this->end(); ?>

<?php $this->start('form.sidebar'); ?>

<?=
	$this->Form->control('is_published', [
		'type' => 'switch'
	]);
?>
<?php $this->end() ?>

