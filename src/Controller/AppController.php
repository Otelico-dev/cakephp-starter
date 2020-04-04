<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('Security');`
	 *
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();

		$this->loadComponent('RequestHandler', [
			'enableBeforeRedirect' => false,
		]);
		$this->loadComponent('Flash');

		/*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
		//$this->loadComponent('Security');

		$this->setI18nConfiguration();
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

		if ($this->request->getParam('plugin') == 'DatabaseLog') {
			$this->viewBuilder()->setLayout('AdminTheme.admin');

			if ($this->viewBuilder()->getClassName() === null) {
				$this->viewBuilder()->setClassName('AdminTheme.App');
			}
		}

		if (
			$this->request->getParam('controller') == 'Users'
			&& in_array($this->request->getParam('action'), [
				'login',
				'requestResetPassword',

			])
		) {

			$this->viewBuilder()->layout('login');
		}

		if (isset($this->accepted_languages)) {
			$this->set('accepted_languages', $this->accepted_languages);
			$this->set('default_language', $this->default_language);
			$this->set('language', $this->language);
		}
	}

	protected function setI18nConfiguration()
	{

		if (Configure::read('I18n')) {
			$this->accepted_languages = Configure::read('I18n.languages');

			$this->default_language = Configure::read('I18n.defaultLanguage');
			$this->language = Configure::read('App.language');
		}
	}
}
