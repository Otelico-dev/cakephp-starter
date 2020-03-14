<?php

namespace Media\Model\Entity;

use Cake\ORM\Entity;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Media Entity.
 */
class Media extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'*' => true
	];

	protected $_virtual = [
		'file_path'
	];

	private $pictures = [
		'jpg',
		'png',
		'gif',
		'bmp'
	];

	public $icon;

	public $type;

	/**
	 *
	 * @return string
	 */
	protected function _getFileType()
	{
		if (isset($this->file)) {
			$extension = \pathinfo($this->file, PATHINFO_EXTENSION);
			if (!\in_array($extension, $this->pictures)) {
				return $this->type = $extension;
			} else {
				return $this->type = 'pic';
			}
		}
	}

	/**
	 *
	 * @return string
	 */
	protected function _getFileIcon()
	{
		if (isset($this->file)) {
			$extension = \pathinfo($this->file, PATHINFO_EXTENSION);
			if (!\in_array($extension, $this->pictures)) {
				return $this->icon = 'Media.' . $extension . '.png';
			} else {
				return $this->icon = $this->file;
			}
		}
	}

	/**
	 *
	 * @return string
	 */
	protected function _getFilePath()
	{
		return DS . strtolower($this->model) . DS . $this->foreign_key . DS;
	}

	/**
	 *
	 * @return string
	 */
	protected function _getFileInfo()
	{

		$file = new File(WWW_ROOT . ltrim($this->file, '/'));

		return $file->info();
	}

	/**
	 *
	 * @return string
	 */
	protected function _getDimensions()
	{
		if (isset($this->file)) {
			$file = WWW_ROOT . $this->file;

			if (!file_exists($file)) return false;

			list($width, $height) = getimagesize($file);

			$dimensions = new \stdClass();
			$dimensions->width = $width;
			$dimensions->height = $height;

			return $dimensions;
		}
	}
}
