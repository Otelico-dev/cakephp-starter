<?php

namespace Media\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Utility\Hash;
use ArrayObject;

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
	 * Holds eerors found when uploading files
	 * @var array
	 */
	protected $upload_errors = [];

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

		$this->_table->hasMany('MediaFiles', [
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

	public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
	{

		if (
			!empty($this->_config['fields'])
		) {

			foreach ($this->_config['fields'] as $field) {
				if (empty($_FILES[$field['name']]['tmp_name'])) {
					$data[$field['name']] = 'true';
				}
			}
		}
	}

	public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
	{
		if (empty($this->_config['fields'])) {
			return $query;
		}

		$fields = $this->_config['fields'];
		$field_names = Hash::extract($fields, '{n}.name');

		if (empty($field_names)) {
			return $query;
		}

		$mapper = function ($row, $key, $mapReduce) use ($fields) {

			if (!empty($row->media_files)) {
				foreach ($fields as $field) {

					foreach ($row->media_files as $media) {


						if ($media->name == $field['name']) {

							$row[$field['name']] = $media;
						}
					}
				}
			}

			$mapReduce->emitIntermediate($row, $key);
		};

		$reducer = function ($items, $key, $mapReduce) {
			if (isset($items[0])) {
				$mapReduce->emit($items[0], $key);
			}
		};

		$query->contain('MediaFiles', function (Query $q) use ($field_names) {
			return $q->where(['MediaFiles.name IN' => $field_names]);
		});

		$query->mapReduce($mapper, $reducer);

		return $query;
	}

	public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
	{

		if (
			!empty($this->_config['fields'])
		) {


			foreach ($this->_config['fields'] as $field) {
				$this->checkFileForErrors($field['name']);
			}

			if (!empty($this->upload_errors)) {
				$entity->setErrors($this->upload_errors);
				return false;
			}

			$entity->{$field['name']} = '';
		}

		return true;
	}

	protected function checkFileForErrors($field)
	{

		if (empty($_FILES[$field]['tmp_name'])) {
			return;
		}

		try {
			$this->_table->media->setFileHandle($_FILES[$field]);
			$this->_table->media->checkForUploadedFileErrors($_FILES[$field]['tmp_name']);
		} catch (\Exception $e) {
			$this->upload_errors[$field] = $e->getMessage();
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
			!empty($this->_config['fields'])
		) {

			foreach ($this->_config['fields'] as $field) {

				if (empty($_FILES[$field['name']]['tmp_name'])) {
					continue;
				}

				try {

					$this->saveMedia($entity, $field['name']);
				} catch (\Exception $e) {

					throw new \Exception($e->getMessage());
				}
			}
		}
	}

	/**
	 * Save a media file
	 * @param String $field_name
	 */
	protected function saveMedia(Entity $entity, String $field_name)
	{

		if (
			!$media = $this->_table->media->find()
				->where([
					'model' => strtolower($this->_table->alias()),
					'foreign_key' => $entity->id,
					'name' => $field_name
				])
				->first()
		) {
			$media = $this->_table->media->newEntity();
		}

		$media->model = strtolower($this->_table->alias());
		$media->foreign_key = $entity->id;
		$media->field_type = 'field';
		$media->name = $field_name;

		$media->tmp_name = $_FILES[$field_name]['tmp_name'];

		$this->_table->media->save($media);
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
			'Media' => function ($q) {

				return $q->where(['field_type !=' => 'field'])
					->order(['Media.position' => 'ASC']);
			}
		]);

		return $query;
	}
}
