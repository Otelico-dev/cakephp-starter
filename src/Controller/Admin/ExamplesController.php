<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use DataTables\Controller\DataTablesAjaxRequestTrait;

/**
 * Examples Controller
 *
 * @property \App\Model\Table\ExamplesTable $Examples
 *
 * @method \App\Model\Entity\Example[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamplesController extends AppController
{

	use DataTablesAjaxRequestTrait;


	public function beforeFilter(\Cake\Event\Event $event)
	{
		parent::beforeFilter($event);

		$this->setDataTablesConfiguration();
	}

	protected function setDataTablesConfiguration()
	{
		$this->DataTables->createConfig('Examples')
			->options([
				'rowReorder' =>  ['update' => false],
			])
			->column('Examples.id', ['label' => 'ID'])
			->column('Examples.title', ['label' => 'Title'])
			->column('Examples.is_published', ['label' => 'Published'])

			->column('actions', ['label' => 'Actions', 'class' => 'actions', 'database' => false])
			->finder('position');
	}

	public function index()
	{

		$this->DataTables->setViewVars('Examples');
		$this->Meta->setMetaData();
	}
}
