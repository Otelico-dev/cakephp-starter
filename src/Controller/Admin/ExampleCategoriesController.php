<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use DataTables\Controller\DataTablesAjaxRequestTrait;

/**
 * ExampleCategories Controller
 *
 * @property \App\Model\Table\ExampleCategoriesTable $ExampleCategories
 *
 * @method \App\Model\Entity\ExampleCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExampleCategoriesController extends AppController
{

	use DataTablesAjaxRequestTrait;


	public function beforeFilter(\Cake\Event\Event $event)
	{
		parent::beforeFilter($event);

		$this->setDataTablesConfiguration();
	}

	protected function setDataTablesConfiguration()
	{
		$this->DataTables->createConfig('ExampleCategories')
			->column('ExampleCategories.id', ['label' => 'ID'])
			->column('ExampleCategories.title', ['label' => 'Titre'])
			->column('actions', ['label' => 'Actions', 'class' => 'actions', 'database' => false])
			->finder('position');
	}

	public function index()
	{
		$this->DataTables->setViewVars('ExampleCategories');
		$this->Meta->setMetaData();
	}
}
