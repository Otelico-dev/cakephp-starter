<h1><?= (!$exampleCategory->isNew()) ? __d('admin', 'Modifier la catégorie exemple') . ' #' . $exampleCategory->id : __d('admin', 'Ajouter une  catégorie exemple'); ?></h1>
<?= $this->Form->create($exampleCategory) ?>
<p class="text-right form__submit-container"><?= $this->Form->button(__d('admin', 'Sauvegarder'), ['class' => 'btn-lg']); ?></p>
<fieldset class="form__container form-group">
	<?=
		$this->Element('AdminTheme.Forms/translated_inputs', [
			'inputs' => [
				[
					'name' => 'title',
					'label' => __d('admin', 'Titre')
				]
			]
		]);

	?>
</fieldset>

<?= $this->Form->end(); ?>