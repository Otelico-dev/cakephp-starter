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

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

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

	use \Crud\Controller\ControllerTrait;

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

		$this->loadComponent('Security');

		$this->Security->setConfig([
			'unlockedActions' => ['reorder', 'publish'],
			'unlockedFields' => ['is_published']
		]);

		$this->loadComponent('CakeDC/Users.UsersAuth');

		$this->loadComponent('DataTables.DataTables', [
			'language' => [
				'url' => '//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
			]
		]);

		$this->loadComponent('Crud.Crud', [
			'actions' => [
				'add' => [
					'className' => 'Crud.Add',
					'relatedModels' => true,
					'messages' => [
						'success' => [
							'text' => __d('admin', 'Enregistrement créé avec succès')
						],
						'error' => [
							'text' => __d('admin', 'Impossible de créer un l\'enregistrement')
						]
					],
				],
				'edit' => [
					'className' => 'Crud.Edit',
					'relatedModels' => true,
					'messages' => [
						'success' => [
							'text' => __d('admin', 'Enregistrement mis à jour avec succès')
						],
						'error' => [
							'text' => __d('admin', 'Impossible de mettre à jour l\'enregistrement')
						]
					],
				],
				'delete' => [
					'className' => 'Crud.Delete',
					'messages' => [
						'success' => [
							'text' => __d('admin', 'Supprimé avec succès')
						],
						'error' => [
							'text' => __d('admin', 'Impossible de supprimer')
						]
					],
				],
				'reorder' => [
					'className' => '\App\Crud\Action\ReorderAction',
				],
				'publish' => [
					'className' => '\App\Crud\Action\PublishAction',
				],
			],
			'listeners' => [
				'Crud.RelatedModels',
				'Crud.Redirect',
			],
		]);

		$this->loadComponent('AdminTheme.Translate');
		$this->loadComponent('AdminTheme.Meta');

		if (Configure::read('I18n')) {

			$this->accepted_languages = Configure::read('I18n.languages');
		}
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

		$this->viewBuilder()->setLayout('AdminTheme.admin');

		if ($this->viewBuilder()->getClassName() === null) {
			$this->viewBuilder()->setClassName('AdminTheme.AdminApp');
		}

		if (isset($this->accepted_languages)) {
			$this->set('accepted_languages', $this->accepted_languages);
		}

		$this->set('module_navigation', Configure::read('modules'));
	}
}
