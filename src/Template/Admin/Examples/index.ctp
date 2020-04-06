<?php
$this->Breadcrumbs->add(
	__d('admin', 'Exemples'),
	['controller' => 'Exemples', 'action' => 'index']
);

?>

<h1><?= __d('admin', 'Exemples'); ?></h1>

<p class="text-right">
	<?= $this->Html->link(
		'<i class="fa fa-plus"></i> ' . __d('admin', 'Nouveau Exemple'),
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
				'Examples',
				[
					'class' => 'table table-striped',

				]
			)
		?>
	</div>

</div>