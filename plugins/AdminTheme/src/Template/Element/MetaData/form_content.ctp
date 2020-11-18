<?php

$controls = [];
$controls['title'] = [
	'label' => __d('admin', 'Titre')
];
$controls['introduction'] = [
	'label' => __d('admin', 'Introduction'),
	'type' => 'textarea',
	'rich_text' => true
];
$controls['outroduction'] = [
	'label' => __d('admin', 'Outroduction'),
	'type' => 'textarea',
	'rich_text' => true
];

if (isset($translate)) {

	$controls = [
		'translated' => [
			[
				'name' => 'title',
				'label' => __d('admin', 'Titre')
			],
			[
				'name' => 'introduction',
				'label' => __d('admin', 'Introduction'),
				'type' => 'textarea',
				'rich_text' => true
			],
			[
				'name' => 'outroduction',
				'label' => __d('admin', 'Outroduction'),
				'type' => 'textarea',
				'rich_text' => true
			]
		]
	];
}

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
