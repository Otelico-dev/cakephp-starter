<?php

namespace AdminTheme\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;


class TranslateComponent extends Component
{

	protected $controller;
	protected $model;

	public function initialize(array $config)
	{
		$this->controller = $this->_registry->getController();
		$this->model = $this->controller->loadModel($this->controller->modelClass);
	}


	public function beforeFilter(Event $event)
	{
		// parent::beforeFilter($event);


		if (
			($this->controller->request->getParam('action') == 'add' || $this->controller->request->getParam('action') == 'edit')
			&& $this->model->behaviors()->has('Translate')
		) {


			$this->controller->set('translated_fields', $this->model->behaviors()->get('Translate')->config()['fields']);


			$this->controller->Crud->on('beforeFind', function (\Cake\Event\Event $event) {

				$event->getSubject()->query = $this->model->find('translations')->where([$this->model->aliasField('id') => $event->getSubject()->id]);
			});
		}
	}
}
