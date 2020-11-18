<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use DataTables\Controller\DataTablesAjaxRequestTrait;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 *
 * @method \App\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{

	use DataTablesAjaxRequestTrait;


	public function beforeFilter(\Cake\Event\Event $event)
	{
		parent::beforeFilter($event);

		$this->setDataTablesConfiguration();
	}

	protected function setDataTablesConfiguration()
	{
		$this->DataTables->createConfig('Pages')
			->options(['stateSave' => true])
			->column('Pages.id', ['label' => 'ID'])
			->column('actions', ['label' => 'Actions', 'class' => 'actions', 'database' => false]);
	}

	public function index()
	{
		$this->DataTables->setViewVars('Pages');
	}

	public function edit($id = NULL)
	{
		$this->Meta->setMetaData('index', $id);

		return $this->Crud->execute();
	}
}
