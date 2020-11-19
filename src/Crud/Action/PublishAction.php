<?php

namespace App\Crud\Action;

use Cake\Http\Exception\BadRequestException;

class PublishAction extends \Crud\Action\BaseAction
{

	/**
	 * Default settings
	 *
	 * @var array
	 */
	protected $_defaultConfig = [
		'enabled' => true,
		'scope' => 'table',
		'findMethod' => 'all',
		'view' => null,
		'viewVar' => null,
		'serialize' => [],
		'api' => [
			'success' => [
				'code' => 200
			],
			'error' => [
				'code' => 400
			]
		]
	];

	/**
	 * Generic handler for all HTTP verbs
	 *
	 * @return void
	 */

	protected function _handle($id = null)
	{

		if (!$this->_controller()->request->is('ajax')) {
			throw new BadRequestException();
		}

		$entity = $this->_table()->get($id);
		$entity = $this->_table()->togglePublished($entity);

		return $this->_controller()->response
			->withType('application/json')
			->withStringBody(json_encode([
				'is_published' => $entity->is_published,
			]));
	}
}
