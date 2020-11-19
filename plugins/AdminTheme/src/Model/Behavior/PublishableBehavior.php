<?php

namespace AdminTheme\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;

class PublishableBehavior extends Behavior
{

	protected $_defaultConfig = [
		'field' => 'is_published',
	];

	public function initialize(array $config)
	{

		$this->config = array_merge($this->_defaultConfig, $config);
	}

	public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
	{
		if (empty($data[$this->config['field']])) {
			$data[$this->config['field']] = 'false';
		}
	}

	public function togglePublished(EntityInterface $entity)
	{

		if (!in_array('Publishable', $this->_table->Behaviors()->loaded())) {
			throw new MethodNotAllowedException();
		}

		$entity->{$this->config['field']} = ($entity->{$this->config['field']} == 'false')
			? 'true'
			: 'false';

		$this->_table->save($entity);

		return $entity;
	}
}
