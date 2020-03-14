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

	<?= $this->Html->css('/assets/admin/dist/css/app') ?>
	<?= $this->fetch('css') ?>

</head>

<body>
	<header>
		<div class="container-fluid">
			<?= $this->Element('Layout/Admin/header') ?>
		</div>
	</header>
	<aside>
		<?= $this->Element('Layout/Admin/sidebar') ?>
	</aside>

	<main class="container-fluid">

		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>

	</main>

	<footer>
		<?= $this->Element('Layout/Admin/footer') ?>
	</footer>
	<?= $this->Html->script('/assets/admin/dist/js/app') ?>
	<?= $this->DataTables->setJs() ?>
</body>

</html>