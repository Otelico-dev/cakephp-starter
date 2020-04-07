<?php

namespace Media\Controller;

use Cake\Event\Event;


class FileBrowserController extends AppController
{

	/**
	 * beforeFilter callback
	 *
	 * @return void
	 */
	public function beforeFilter(Event $event)
	{
		$this->loadComponent('CakeDC/Users.UsersAuth');
	}

	/**
	 * Before render callback.
	 *
	 * @param \Cake\Event\Event $event the beforeRender event
	 *
	 * @return \Cake\Http\Response|null|void
	 */
	public function beforeRender(Event $event)
	{

		$this->viewBuilder()->setLayout('Media.browser');
	}

	public function index()
	{
	}
}
