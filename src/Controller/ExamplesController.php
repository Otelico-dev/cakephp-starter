<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Examples Controller
 *
 * @property \App\Model\Table\ExamplesTable $Examples
 *
 * @method \App\Model\Entity\Example[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamplesController extends AppController
{
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function index()
	{
		$examples = $this->Examples->find('media')
			->contain([
				'ExampleCategories'
			]);

		$this->set(
			compact(
				'examples'
			)
		);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Example id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$example = $this->Examples->get($id, [
			'contain' => [
				'ExampleCategories',
				'Media' => ['sort' => 'position ASC'],
				'MediaFiles'
			],
		]);

		$this->set('example', $example);
	}
}
