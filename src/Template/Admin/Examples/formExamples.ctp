<?php

$controls = [];

$controls['translated'] = [
	[
		'name' => 'title',
		'label' => __d('admin', 'Titre')
	],
	[
		'name' => 'description',
		'label' => __d('admin', 'Description'),
		'rich_text' => true
	]
];

$sidebar['example_category_id'] = [
	'label' => __d('admin', 'Example Category Id')
];

$sidebar['is_published'] = [
	'label' => __d('admin', 'Is Published'),
	'type' => 'switch'
];

$sidebar['expiry_date'] = [
	'label' => __d('admin', 'Expiry Date'),
	'type' => 'datepicker',
	'empty' => true
];

echo $this->Element('AdminTheme.Forms/form', [
	'entity' => $example,
	'controls' => $controls,
	'sidebar' => $sidebar
]);
