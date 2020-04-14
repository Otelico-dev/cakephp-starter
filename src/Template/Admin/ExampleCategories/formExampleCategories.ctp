<?php

$controls = [];

$controls['translated'] = [
	[
		'name' => 'title',
		'label' => __d('admin', 'Titre')
	]
];

echo $this->Element('AdminTheme.Forms/form', [
	'entity' => $exampleCategory,
	'controls' => $controls
]);
