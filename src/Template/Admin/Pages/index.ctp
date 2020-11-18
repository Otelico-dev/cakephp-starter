<?php

$this->extend('AdminTheme./Common/index_datatables');

$this->Breadcrumbs->add(
	__d('admin', 'Pages'),
	['controller' => 'pages', 'action' => 'index']
);

$this->assign('title', __d('admin', 'Pages'));

$this->assign(
	'link_add',
	$this->Element('AdminTheme.Actions/link_add', [
		'text' => __d('admin', 'New Page'),
	])
);

$this->assign('datatables_variable', 'Pages');
