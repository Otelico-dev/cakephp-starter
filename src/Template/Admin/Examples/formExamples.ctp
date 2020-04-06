<?= $this->Form->create($example) ?>
<p class="text-right form__submit-container"><?= $this->Form->button(__d('admin', 'Sauvegarder'), ['class' => 'btn-lg']); ?></p>
<div class="row">
	<fieldset class="form__container form-group col-sm-12 col-md-8">

		<?=
			$this->Element('AdminTheme.Forms/translated_inputs', [
				'inputs' => [
					[
						'name' => 'title',
						'label' => __d('admin', 'Titre')
					],
					[
						'name' => 'description',
						'label' => __d('admin', 'Description'),
						'rich_text' => true
					]
				]
			]);

		?>

	</fieldset>
	<fieldset class="form__container--sidebar form-group col-sm-12 col-md-4">


		<?php
		echo $this->Form->control('example_category_id', [
			'type' => 'select',
			'empty' => __d('admin', 'Choisir'),
			'placeholder' => __d('admin', 'Choissisez un option')
		]);

		echo $this->Form->control('expiry_date', [
			'type' => 'datepicker'
		]);
		echo $this->Form->control('is_published', [
			'type' => 'switch'
		]);

		?>
	</fieldset>
</div>



<?= $this->Form->end(); ?>