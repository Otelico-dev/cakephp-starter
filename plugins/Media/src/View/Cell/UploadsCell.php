<?php

namespace Media\View\Cell;

use Cake\View\Cell;

/**
 * Uploads cell
 */
class UploadsCell extends Cell
{
	/**
	 * List of valid options that can be passed into this
	 * cell's constructor.
	 *
	 * @var array
	 */
	protected $_validCellOptions = [];

	/**
	 * Initialization logic run at the end of object construction.
	 *
	 * @return void
	 */
	public function initialize()
	{
		$this->loadModel('Media.Medias');
	}

	/**
	 * Default display method.
	 *
	 * @return void
	 */
	public function display(int $foreign_key, string $model)
	{

		$medias = $this->Medias->find('all', [
			'conditions' => [
				'foreign_key' => $foreign_key,
				'model' => $model,
				'field_type !=' => 'field'
			],
			'order' => ['position ASC'],
		])->toArray();

		$this->set(compact(
			'medias',
			'foreign_key',
			'model'
		));
	}
}
