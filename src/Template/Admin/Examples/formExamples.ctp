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
	'label' => __d('admin', 'Catégorie exemple'),
	'empty' => __d('admin', 'Choisir'),
	'placeholder' => __d('admin', 'Choissisez un option')
];

$sidebar['is_published'] = [
	'label' => __d('admin', 'Publié'),
	'type' => 'switch'
];

$sidebar['expiry_date'] = [
	'label' => __d('admin', 'Date d\'expiration'),
	'type' => 'datepicker',
	'empty' => true
];

echo $this->Element('AdminTheme.Forms/form', [
	'entity' => $example,
	'controls' => $controls,
	'sidebar' => $sidebar
]);
