<?php

$this->extend('AdminTheme./Common/index_datatables_with_meta_data');

$this->Breadcrumbs->add(
	__d('admin', 'Catégories exemples'),
	['controller' => 'exampleCategories', 'action' => 'index']
);

$this->assign('title', __d('admin', 'Catégories exemples'));

$this->assign(
	'link_add',
	$this->Element('AdminTheme.Actions/link_add', [
		'text' => __d('admin', 'Nouvelle catégorie exemple'),
	])
);

$this->assign('datatables_variable', 'ExampleCategories');
