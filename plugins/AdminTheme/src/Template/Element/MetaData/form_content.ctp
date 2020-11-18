<?php

$controls = [];
$controls['title'] = [
	'label' => __d('admin', 'Titre')
];
$controls['introduction'] = [
	'label' => __d('admin', 'Introduction'),
	'rich_text' => true
];
$controls['outroduction'] = [
	'label' => __d('admin', 'Outroduction'),
	'rich_text' => true
];
$controls['controller'] = [
	'label' => false,
	'type' => 'hidden',
	'value' => $controller
];
$controls['action'] = [
	'label' => false,
	'type' => 'hidden',
	'value' => $action
];

$controls['redirect_url'] = [
	'label' => false,
	'type' => 'hidden',
	'value' => (isset($redirect_url)) ? $this->Url->build($redirect_url) : $this->Url->build(['controller' => $this->request->controller])
];

echo $this->Element('AdminTheme.Forms/form', [
	'entity' => $metaData,
	'controls' => $controls,
	'options' => [
		'url' => [
			'controller' => 'MetaData',
			'action' => ($metaData === null) ? 'add' : 'edit',
			'plugin' => 'AdminTheme'
		]
	],
]);
