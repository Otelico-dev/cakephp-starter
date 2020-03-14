<?php

return [
	'Auth' => [
		'loginRedirect' => [
			'controller' => 'Members',
			'action' => 'index',
			'prefix' => 'admin',
			'plugin' => false
		]
	]
];
