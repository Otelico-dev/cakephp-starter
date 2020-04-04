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

<body class="body--login">
	<main class="container-login">

		<div class="content-login">
			<?= $this->fetch('content') ?>
		</div>

	</main>
</body>

</html>