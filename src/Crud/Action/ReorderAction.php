<?php

namespace App\Crud\Action;

use Cake\Http\Exception\BadRequestException;

class ReorderAction extends \Crud\Action\BaseAction
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

	protected function _post()
	{

		if (!$this->_controller()->request->is('ajax')) {
			throw new BadRequestException();
		}

		if ($data = $this->_controller()->request->getData('data')) {

			foreach ($data as $datum) {
				$entity  = $this->_table()->get($datum['id']);
				$entity->position = $datum['new_position'];
				$this->_table()->save($entity);
			}
		}

		return $this->_controller()->response
			->withType('application/json')
			->withStringBody(json_encode([
				'state' => 'success',
			]));
	}
}
