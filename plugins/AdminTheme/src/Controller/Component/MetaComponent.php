<?php

namespace AdminTheme\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;

/**
 * MetaData component
 */
class MetaComponent extends Component
{
	/**
	 * Default configuration.
	 *
	 * @var array
	 */
	protected $_defaultConfig = [];

	protected $_controller;

	public function initialize(array $config)
	{
		$this->_controller = $this->getController();
		$this->_controller->loadModel('AdminTheme.MetaData');
	}

	public function setMetaData($action = 'index', $identifier = NULL)
	{

		$conditions = [
			'controller' => $this->getController()->name,
			'action' => $action
		];
		if (!empty($identifier)) {
			$conditions['identifier'] = $identifier;
		}

		$find_type = 'all';

		if (Configure::read('I18n')) {
			$this->_controller->set('translate', true);
			$find_type = 'translations';
		}

		$meta_data = $this->_controller->MetaData->find($find_type)
			->where($conditions)
			->first();

		$this->_controller->set('controller', $this->getController()->name);
		$this->_controller->set('action', $action);

		$this->_controller->set('metaData', $meta_data);
	}
}
