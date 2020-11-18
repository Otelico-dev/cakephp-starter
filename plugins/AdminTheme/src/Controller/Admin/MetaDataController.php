<?php

namespace AdminTheme\Controller\Admin;

use AdminTheme\Controller\AppController;
use Cake\Core\Configure;

/**
 * MetaData Controller
 *
 *
 * @method \AdminTheme\Model\Entity\MetaData[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MetaDataController extends AppController
{
	use \Crud\Controller\ControllerTrait;

	public function initialize()
	{
		parent::initialize();

		$this->loadComponent('Crud.Crud', [
			'actions' => [
				'add' => [
					'className' => 'Crud.Add',
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
					'messages' => [
						'success' => [
							'text' => __d('admin', 'Enregistrement mis à jour avec succès')
						],
						'error' => [
							'text' => __d('admin', 'Impossible de mettre à jour l\'enregistrement')
						]
					],
				]
			]
		]);
	}
}
