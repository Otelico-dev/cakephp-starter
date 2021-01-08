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
		$config = $this->getConfig();
		return $query->order([$this->_table->aliasField($config['field']) => 'ASC']);
	}

	public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
	{

		$config = $this->config();

		if ($entity->isNew()) {

			$query = $this->_table->find();

			$query->select([
				'max_position' => $query->func()->max(
					$this->_table->aliasField($config['field'])
				)
			]);

			$position = $query->first();

			$entity->{$config['field']} = $position->max_position + 1;
		}
	}
}
