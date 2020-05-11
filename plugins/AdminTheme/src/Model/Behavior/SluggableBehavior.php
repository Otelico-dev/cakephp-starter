<?php

namespace AdminTheme\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;
use Cake\Utility\Inflector;

class SluggableBehavior extends Behavior
{

	protected $_defaultConfig = [
		'fields' => [],
	];

	public function initialize(array $config)
	{

		$this->config = array_merge($this->_defaultConfig, $config);
	}

	public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
	{

		if (empty($this->config['fields'])) {
			return true;
		}

		foreach ($this->config['fields'] as $key => $field) {

			if ($this->isTranslations($key)) {

				$entity = $this->slugTranslations($entity);
			} else {
				$entity->{$field} = $this->slug($entity->{$field});
			}
		}
	}

	protected function isTranslations(string $key): bool
	{
		return $key == '_translations';
	}

	protected function slugTranslations(EntityInterface $entity): EntityInterface
	{

		foreach ($this->config['fields']['_translations'] as $translated_field) {

			foreach ($entity->_translations as $locale => $translation) {

				$entity->_translations[$locale]->{$translated_field} = $this->slug($entity->_translations[$locale]->{$translated_field});
			}
		}

		return $entity;
	}

	protected function slug(string $string): string
	{
		return strtolower(Inflector::slug($string));
	}
}
