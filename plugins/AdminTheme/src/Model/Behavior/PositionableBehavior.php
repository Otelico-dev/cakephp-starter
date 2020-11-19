<?php

namespace AdminTheme\Model\Behavior;

use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;

class PositionableBehavior extends Behavior
{

	protected $_defaultConfig = [
		'field' => 'position',
	];

	public function findPosition(Query $query, array $options)
	{
		$config = $this->config();
		return $query->order([$this->_table->aliasField($config['field']) => 'ASC']);
	}

	public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
	{

		$config = $this->config();

		if ($entity->isNew()) {
			$max_position = $this->_table->find()
				->select([
					$this->_table->aliasField($config['field']) => 'MAX(' . $config['field'] . ')'
				])
				->first();

			$entity->{$config['field']} = $max_position[$config['field']] + 1;
		}
	}
}
