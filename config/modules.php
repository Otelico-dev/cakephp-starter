<?php


return [
	'modules' => [
		[
			'title' => __d('admin', 'Pages'),
			'url' => ['controller' => 'pages', 'action' => 'index']
		],
		[
			'title' => __d('admin', 'Examples'),
			'url' => ['controller' => 'examples', 'action' => 'index']
		],
		[
			'title' => __d('admin', 'Catégories exemples'),
			'url' => ['controller' => 'exampleCategories', 'action' => 'index']
		]
	]
];
