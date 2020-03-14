<?php

namespace Media\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Table;

class MediaBehavior extends Behavior
{

	/**
	 * Default options
	 *
	 * @var array
	 */
	protected $config = [
		'type' => 'multiple',
		'field' => 'files',
		'path' => 'img/uploads/%y/%m/%f',
		'extensions' => [
			'jpg',
			'png'
		],
		'limit' => 0,
		'max_width' => 0,
		'max_height' => 0,
		'size' => 0,
		'uploads_dir' => 'uploads'
	];

	/**
	 * Add HasMany association in table whith this behavior.
	 * If database table has 'media_id' field, the behavior add belongsTo association
	 *
	 * (non-PHPdoc)
	 *
	 * @see \Cake\ORM\Behavior::initialize()
	 * @param array $config
	 *            The configuration settings provided to this behavior.
	 * @return void
	 */
	public function initialize(array $config)
	{

		$this->_table->medias = array_merge($this->config, $config);
		$this->_table->hasMany('Media', [
			'className' => 'Media.Medias',
			'foreignKey' => 'foreign_key',
			'order' => 'Media.position ASC',
			'conditions' => 'model = "' . $this->_table->getAlias() . '"',
			'dependant' => true
		]);

		if ($this->_table->hasField('media_id')) {
			$this->_table->belongsTo('Thumb', [
				'className' => 'Media.Medias',
				'foreignKey' => 'media_id'
			]);
		}
	}

	public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
	{

		if (
			isset($this->_config['type'])
			&& $this->_config['type'] == 'single'
		) {

			$field = $this->_config['field'];

			if (empty($entity->{$field}['tmp_name'])) {
				return true;
			}

			try {

				$this->_table->media->setFileHandle($entity->{$field});

				$this->_table->media->checkForUploadedFileErrors();
			} catch (\Exception $e) {

				$entity->setErrors([$field => [$e->getMessage()]]);

				return false;
			}
		}
	}

	/**
	 *
	 * @param \Cake\Event\Event $event            
	 * @param \Cake\ORM\Entity $entity            
	 * @param \ArrayObject $options            
	 * @return void
	 */
	public function afterSave(Event $event, Entity $entity, \ArrayObject $options)
	{

		if (
			isset($this->_config['type'])
			&& $this->_config['type'] == 'single'
			&& !empty($entity->{$this->_config['field']}['tmp_name'])
		) {

			try {

				$media = $this->_table->media->newEntity();
				$media->ref = strtolower($this->_table->alias());
				$media->ref_id = $entity->id;

				$this->_table->media->save($media);
			} catch (\Exception $e) {

				throw new \Exception($e->getMessage());
			}
		}
	}

	/**
	 * Finds records with associated media
	 * @param  Query  $query   [description]
	 * @param  array  $options [description]
	 * @return Query          [description]
	 */
	public function findMedia($query, array $options)
	{

		$query->contain([
			'Media' => ['sort' => 'position ASC'],
		]);

		return $query;
	}
}
