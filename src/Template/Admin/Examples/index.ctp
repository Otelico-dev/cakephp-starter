<?php

$this->extend('AdminTheme./Common/index_datatables_with_meta_data');

$this->Breadcrumbs->add(
	__d('admin', 'Exemples'),
	['controller' => 'examples', 'action' => 'index']
);

$this->assign('title', __d('admin', 'Exemples'));

$this->assign(
	'link_add',
	$this->Element('AdminTheme.Actions/link_add', [
		'text' => __d('admin', 'New example'),
	])
);

$this->assign('datatables_variable', 'Examples');
