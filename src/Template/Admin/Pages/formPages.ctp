<?php

$controls = [];
$controls['title'] = [
	'label' => __d('admin','Title')
	];
$controls['content'] = [
	'label' => __d('admin','Content'),
	'type' => 'textarea',
	'rich_text' => true
	];



echo $this->Element('AdminTheme.Forms/form', [
		'entity' => $page,
		'controls' => $controls
	]);
