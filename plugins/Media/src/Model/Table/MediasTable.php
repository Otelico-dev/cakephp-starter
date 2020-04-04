<?php

namespace Media\Model\Table;

use Cake\Event\Event;
use Cake\Network\Exception\NotImplementedException;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Validation\Validator;
use Media\Model\Entity\Media;

require_once ROOT . '/plugins/Media/src/Vendor/Upload/class.upload.php';

use Media\Vendor\Upload;

// use Media\Vendor\Upload;

/**
 * Medias Model.
 *
 * @property \Cake\ORM\Association\BelongsTo $Reves
 * @property \Cake\ORM\Association\HasMany   $Actions
 */
class MediasTable extends Table
{
	protected $_imageMimetypes = array(
		'image/bmp',
		'image/gif',
		'image/jpeg',
		'image/pjpeg',
		'image/png',
		'application/pdf'
		// 'image/vnd.microsoft.icon',
		// 'image/x-icon',
	);

	protected $uploads_dir = ROOT . DS . 'uploads';

	protected $handle = false;

	protected $table;

	/**
	 * Initialize method.
	 *
	 * @param array $config
	 *                      configuration for the Table
	 */
	public function initialize(array $config)
	{
		$this->setTable('medias');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
	}

	/**
	 * Delete uploaded files.
	 *
	 * @param \Cake\Event\Event $event
	 * @param \Cake\ORM\Entity  $entity
	 * @param \ArrayObject      $options
	 *
	 * @return bool
	 */
	public function beforeDelete(Event $event, Entity $entity, \ArrayObject $options)
	{
		$file = $this->uploads_dir . $entity->file_path . $entity->file;

		if (file_exists($file)) {
			@\unlink($file);
		}

		return true;
	}

	/**
	 * File treatment, upload and return string to save in database.
	 *
	 * @param \Cake\Event\Event $event
	 * @param \Cake\ORM\Entity  $entity
	 * @param \ArrayObject      $options
	 *
	 * @throws Cake\Network\Exception\NotImplementedException
	 *
	 * @return bool
	 */
	public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
	{

		if (!isset($entity->model)) {
			throw new \Exception(__d('media', 'Entity does not have correct \'model\' parameter'));
		}

		$this->table = TableRegistry::get($entity->model);

		if (!\in_array('Media', $this->table->behaviors()->loaded())) {
			throw new NotImplementedException(__d('media', "The model '{0}' doesn't have a 'Media' Behavior", $entity->model));
		}

		if (!empty($entity->tmp_name)) {
			$this->uploadFile($entity);
		}

		return true;
	}

	protected function uploadFile(Entity $entity)
	{



		if ($entity->field_type != 'field') {
			$entity->position = $this->setPosition($entity);
		}


		try {
			// $this->setFileHandle($options);
			$this->checkForUploadedFileErrors($entity->tmp_name);

			if ($entity->field_type != 'field') {
				$this->setFileName(
					$this->table,
					$entity
				);
			}

			$this->saveUploadedFile(
				$entity
			);

			$entity = $this->setEntityFileDetails($entity);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function setFileHandle($file_array)
	{
		if (empty($file_array['tmp_name'])) {
			throw new \Exception(__d('media', 'No uploaded file found'));
		}

		$this->handle[$file_array['tmp_name']] = $this->initializeFileUpload($file_array);
	}

	public function initializeFileUpload($file)
	{
		return new upload($file, 'fr_FR');
	}

	public function checkForUploadedFileErrors($tmp_name)
	{

		if (!$this->handle[$tmp_name]->uploaded) {

			throw new \Exception(__d('media', 'There was a problem with the file upload'));
		}


		$this->handle[$tmp_name]->allowed = $this->_imageMimetypes;

		if (!in_array($this->handle[$tmp_name]->file_src_mime, $this->_imageMimetypes)) {
			throw new \Exception(__d('media', 'File type not allowed'));
		}

		$this->handle[$tmp_name]->Process();

		if ($this->handle[$tmp_name]->error) {
			$this->handle[$tmp_name]->clean();
			throw new \Exception($this->handle[$tmp_name]->error);
		}
	}

	public function saveUploadedFile($entity)
	{
		$target_dir = $this->setTargetDir($entity);

		$this->handle[$entity->tmp_name]->Process($target_dir);

		if ($this->handle[$entity->tmp_name]->error) {
			throw new \Exception($this->handle[$entity->tmp_name]->error);
		}
	}

	protected function setTargetDir($entity)
	{
		return $this->uploads_dir . DS . strtolower($entity->model) . DS . $entity->foreign_key . DS;
	}

	protected function setEntityFileDetails($entity)
	{
		$entity->file = $this->handle[$entity->tmp_name]->file_dst_name;
		$entity->size = $this->handle[$entity->tmp_name]->file_src_size;
		$entity->file_type = $this->handle[$entity->tmp_name]->file_src_mime;
		$entity->width = $this->handle[$entity->tmp_name]->image_src_x;
		$entity->height = $this->handle[$entity->tmp_name]->image_src_y;

		return $entity;
	}

	public function setFileName(
		$table,
		$entity
	) {
		if (!empty($table->medias['filename_format'])) {
			$filename = '';

			$parent_record = $this->getParentRecord($table, $entity->foreign_key);

			$filename .= $this->setFilenamePrefix($table);

			$filename .= $this->setFilenameFieldValues($table, $parent_record);

			$filename .= $this->setFilenameSuffix($table);

			$filename .= $entity->position;

			$filename .= '-' . time();

			$this->handle[$entity->tmp_name]->file_src_name_body = strtolower(Inflector::slug($filename));
		}
	}

	protected function getParentRecord($table, $foreign_key)
	{
		$parent_record = $table->find()
			->where([$table->getAlias() . '.id' => $foreign_key]);

		if (!empty($table->medias['filename_format']['contain'])) {
			$parent_record->contain($table->medias['filename_format']['contain']);
		}

		return $parent_record->first();
	}

	protected function setFilenamePrefix($table)
	{
		if (!empty($table->medias['filename_format']['prefix'])) {
			return $table->medias['filename_format']['prefix']
				. $table->medias['filename_format']['seperator'];
		}

		return '';
	}

	protected function setFilenameFieldValues($table, $parent_record)
	{
		$filename_text = '';

		if (!empty($table->medias['filename_format']['fields'])) {
			foreach ($table->medias['filename_format']['fields'] as $field) {
				if (strpos($field, '.') !== false) {
					$field_parts = explode('.', $field);
					$filename_text .= $parent_record->{$field_parts[0]}->{$field_parts[1]};
				} else {
					$filename_text .= $parent_record->{$field};
				}

				if (!empty($filename_text)) {
					$filename_text .= $table->medias['filename_format']['seperator'];
				}
			}
		}

		return $filename_text;
	}

	protected function setFilenameSuffix($table)
	{
		if (!empty($table->medias['filename_format']['suffix'])) {
			return $table->medias['filename_format']['suffix'] . $table->medias['filename_format']['seperator'];
		}

		return '';
	}

	protected function setPosition($entity)
	{
		if (!empty($entity->position)) {
			return $entity->position;
		}

		$last_item = $this->find()
			->select(['model', 'foreign_key', 'position'])
			->where([
				'model' => $entity->model,
				'foreign_key' => $entity->foreign_key,
				'field_type !=' => 'field'
			])
			->order(['position' => 'desc'])
			->first();

		if (empty($last_item)) {
			return 1;
		} else {
			return $last_item->position + 1;
		}
	}

	/**
	 * Alias for move_uploded_file function.
	 *
	 * @param string $filename
	 * @param string $destination
	 *
	 * @return bool
	 */
	protected function moveUploadedFile($filename, $destination)
	{
		return \move_uploaded_file($filename, $destination);
	}

	/**
	 * Test if file $dir exists.
	 * If it's the case, add a {n} before the extension.
	 *
	 * @param string $dir
	 * @param int    $count
	 *
	 * @return string
	 */
	protected function testDuplicate(&$dir, $count = 0)
	{
		$file = $dir;
		if ($count > 0) {
			$pathinfo = \pathinfo($dir);
			$file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $count . '.' . $pathinfo['extension'];
		}
		if (!\file_exists(WWW_ROOT . $file)) {
			$dir = $file;

			return $dir;
		} else {
			++$count;
			$this->testDuplicate($dir, $count);
		}
	}
}
