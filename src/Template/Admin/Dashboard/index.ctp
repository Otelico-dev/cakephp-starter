<?= $this->Form->create(null); ?>
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

<?= $this->Form->end(); ?>