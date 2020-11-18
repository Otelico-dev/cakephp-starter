<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Http\Exception\NotFoundException;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 *
 * @method \App\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{
	public function index($id = null, $slug = NULL)
	{


		if (
			null === ($this->request->getParam('home'))
			&& !is_numeric($id)
		) {
			throw new NotFoundException();
		}


		$conditions = [
			$this->Pages->aliasField('is_published')
			=> 'true',
		];
		if ($id) {
			$conditions[$this->Pages->aliasField('id')] = $id;
		} elseif (null !== ($this->request->getParam('home'))) {
			$conditions[$this->Pages->aliasField('is_home')] = 'true';
		}



		$page = $this->Pages->find('Media')
			->where($conditions)
			->first();

		$this->set(compact('page'));

		$this->Meta->setMetaData();
	}
}
