<?php

return [
	'Auth' => [
		'loginRedirect' => [
			'controller' => 'Dashboard',
			'action' => 'index',
			'prefix' => 'admin',
			'plugin' => false
		]
	],
	'Users' => [
		'Registration' => [
			'active' => false
		],
		'RememberMe' => [

			'active' => false,
		],

	]
];
