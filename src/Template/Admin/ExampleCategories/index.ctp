<p class="text-right">
	<?= $this->Html->link(
		'<i class="fa fa-plus"></i> ' . __d('admin', 'Nouvelle catégorie exemple'),
		[
			'action' => 'add'
		],
		[
			'escape' => false,
			'class' => 'btn btn-success btn-lg'
		]
	); ?>
</p>

<div id="clients_index" class="table_wrapper">

	<div class="table-responsive">
		<?=
			$this->DataTables->render(
				'ExampleCategories',
				[
					'class' => 'table table-striped',

				]
			)
		?>
	</div>

</div>