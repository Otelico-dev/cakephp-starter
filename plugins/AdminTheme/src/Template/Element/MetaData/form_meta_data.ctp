<?php

$controls = [];
$controls['meta_title'] = [
	'label' => __d('admin', 'Meta Titre')
];
$controls['meta_description'] = [
	'label' => __d('admin', 'Meta Description'),
	'type' => 'textarea'
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

if (!empty($identifier)) {
	$controls['identifier'] = [
		'label' => false,
		'type' => 'hidden',
		'value' => $identifier
	];
}

$controls['redirect_url'] = [
	'label' => false,
	'type' => 'hidden',
	'value' => (isset($redirect_url)) ? $this->Url->build($redirect_url) : $this->Url->build(['controller' => $controller])
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
