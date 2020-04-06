<?php

$this->Breadcrumbs->add([
	[
		'title' => __d('admin', 'Exemples'),
		'url' => ['controller' => 'examples', 'action' => 'index']
	],

	[
		'title' => (!$example->isNew()) ? __d('admin', 'Modifier l\'exemple') . ' #' . $example->id : __d('admin', 'Ajouter un exemple')
	]
]);

?>

<h1><?= (!$example->isNew()) ? __d('admin', 'Modifier l\'exemple') . ' #' . $example->id : __d('admin', 'Ajouter un exemple'); ?></h1>

<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_navigation', [
		'nav_items' => [
			[
				'id' => 'example_details',
				'label' => __d('admin', 'Détails de l\'exemple')
			],
			[
				'id' => 'example_images',
				'label' => __d('admin', 'Images de l\'exemple')
			]
		]
	]);
?>

<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_content', [
		'tab_panes' => [
			[
				'id' => 'example_details',
				'content' => $this->Element('../Admin/Examples/formExamples')
			],
			[
				'id' => 'example_images',
				'content' => $this->Element('../Admin/Examples/images_examples')
			]
		]
	]);

?>