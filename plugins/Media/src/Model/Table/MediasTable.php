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
		// 'image/vnd.microsoft.icon',
		// 'image/x-icon',
	);

	protected $uploads_dir = ROOT . DS . 'uploads';

	protected $handle = false;

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

		if ($entity->isNew()) {
			$table = TableRegistry::get($entity->model);

			if (!\in_array('Media', $table->behaviors()->loaded())) {
				throw new NotImplementedException(__d('media', "The model '{0}' doesn't have a 'Media' Behavior", $entity->model));
			}

			$entity->position = $this->setPosition($entity);

			try {
				$this->checkForUploadedFileErrors();
				// $handle = $this->setFileHandle($options);

				$this->setFileName(
					$table,
					$entity->foreign_key,
					$entity->position
				);

				$this->saveUploadedFile(
					$entity
				);

				$entity = $this->setEntityFileDetails($entity);
			} catch (\Exception $e) {
				throw new \Exception($e->getMessage());
			}
		}

		return true;
	}

	public function setFileHandle($file_array)
	{
		if (empty($file_array['tmp_name'])) {
			throw new \Exception(__d('media', 'No uploaded file found'));
		}

		$this->handle = $this->initializeFileUpload($file_array);

		// if (
		//     isset($options['files'])
		//     && is_array($options['files'])
		//     ) {

		//     $handle = $this->checkForUploadedFileErrors($handle);
		//     return $handle;

		// } elseif (!empty($options['handle'])) {

		//     return $options['handle'];

		// }

		// throw new \Exception(__d('media','File handle is not correctly set'));
	}

	public function initializeFileUpload($file)
	{
		return new upload($file, 'fr_FR');
	}

	public function checkForUploadedFileErrors()
	{
		if (!$this->handle->uploaded) {
			throw new \Exception(__d('media', 'There was a problem with the file upload'));
		}

		$this->handle->allowed = $this->_imageMimetypes;

		if (!in_array($this->handle->file_src_mime, $this->_imageMimetypes)) {
			throw new \Exception(__d('media', 'File type not allowed'));
		}

		$this->handle->Process();

		if ($this->handle->error) {
			$this->handle->clean();
			throw new \Exception($this->handle->error);
		}
	}

	public function saveUploadedFile($entity)
	{
		$target_dir = $this->setTargetDir($entity);

		$this->handle->Process($target_dir);

		if ($this->handle->error) {
			throw new \Exception($this->handle->error);
		}

		// return [
		//     'file' => $handle->file_dst_name,
		//     'size' => $handle->file_src_size,
		//     'type' => $handle->file_src_mime,
		//     'width' => $handle->image_src_x,
		//     'height' => $handle->image_src_y
		// ];
	}

	protected function setTargetDir($entity)
	{
		return $this->uploads_dir . DS . strtolower($entity->model) . DS . $entity->foreign_key . DS;
	}

	protected function setEntityFileDetails($entity)
	{
		$entity->file = $this->handle->file_dst_name;
		$entity->size = $this->handle->file_src_size;
		$entity->type = $this->handle->file_src_mime;
		$entity->width = $this->handle->image_src_x;
		$entity->height = $this->handle->image_src_y;

		return $entity;
	}

	public function setFileName(
		$table,
		$foreign_key,
		$position
	) {
		if (!empty($table->medias['filename_format'])) {
			$filename = '';

			$parent_record = $this->getParentRecord($table, $foreign_key);

			$filename .= $this->setFilenamePrefix($table);

			$filename .= $this->setFilenameFieldValues($table, $parent_record);

			$filename .= $this->setFilenameSuffix($table);

			$filename .= $position;

			$filename .= '-' . time();

			$this->handle->file_src_name_body = strtolower(Inflector::slug($filename));
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
			->where(['model' => $entity->model, 'foreign_key' => $entity->foreign_key])
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
