<?php

$title = (!$page->isNew()) ? __d('admin', 'Modify Page') . ' #' . $page->id : __d('admin', 'New Page');

$this->Breadcrumbs->add([
	[
		'title' => __d('admin', 'Pages'),
		'url' => ['controller' => 'pages', 'action' => 'index']
	],

	[
		'title' => $title
	]
]);

?>

<h1><?= $title; ?></h1>

<?php if ($page->isNew()) : ?>
	<?= $this->Element('../Admin/Pages/formPages'); ?>

<?php else : ?>
	<?= $this->Element('../Admin/Pages/tabs'); ?>
<?php endif; ?>