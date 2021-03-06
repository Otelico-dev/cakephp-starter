<!DOCTYPE html>
<html>

<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>
	<?= $this->fetch('meta') ?>

	<?= $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); ?>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs4/dt-1.10.18/datatables.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">

	<?= $this->Html->css('/admin_theme/assets/dist/css/app') ?>
	<?= $this->fetch('css') ?>

</head>

<body>
	<header>

		<?= $this->Element('AdminTheme.Layout/Admin/header') ?>

	</header>

	<div class="container-main-content">

		<aside class="sidebar">

			<?= $this->Element('AdminTheme.Layout/Admin/sidebar') ?>
		</aside>

		<div class="content-wrapper">

			<?php

			$this->Breadcrumbs->prepend(
				__d('admin', 'Tableau de bord'),
				['controller' => 'dashboard', 'action' => 'index']
			);

			echo $this->Breadcrumbs->render();

			?>

			<main class="container-fluid">
				<div class="container-content">
					<?= $this->Flash->render() ?>
					<?= $this->fetch('content') ?>
				</div>
			</main>
		</div>

	</div>

	<footer>
		<?= $this->Element('AdminTheme.Layout/Admin/footer') ?>
	</footer>

	<?= $this->Html->script('/admin_theme/assets/dist/js/app') ?>
	<?= $this->Html->script('/admin_theme/ckeditor/ckeditor') ?>

	<?= $this->DataTables->setJs() ?>
	<?= $this->fetch('script') ?>
	<?= $this->fetch('scriptBottom') ?>

</body>

</html>