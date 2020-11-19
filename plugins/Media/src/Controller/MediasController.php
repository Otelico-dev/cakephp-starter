<?php

namespace Media\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;

require_once ROOT . '/plugins/Media/src/Vendor/Upload/class.upload.php';

use Media\Vendor\Upload;

/**
 * Medias Controller.
 *
 *
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediasController extends AppController
{
	protected $_imageMimetypes = array(
		'image/bmp',
		'image/gif',
		'image/jpeg',
		'image/pjpeg',
		'image/png',
		// 'image/vnd.microsoft.icon',
		// 'image/x-icon',
	);

	protected $_mediaMimetypes = array(
		'application/pdf',
		'application/postscript',
	);

	/**
	 * @param \Cake\Event\Event $event
	 */
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->viewBuilder()->layout('uploader');
		if (in_array('Security', $this->components()->loaded())) {
			$this->Security->config('unlockedActions', ['index', 'edit', 'upload', 'order', 'thumb', 'update', 'delete']);
		}
	}

	/**
	 * @param Cake\ORM\Table $model
	 * @param int            $foreign_key
	 *
	 * @return bool
	 */
	public function canUploadMedias($model, $foreign_key)
	{
		return true;
		$user = $this->request->session()->read('Auth.User');

		if (empty($user)) {
			return false;
		}

		if (in_array($user['role'], ['superuser', 'admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Index method.
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index()
	{
		$model = (isset($this->request->query['model']))
			? $this->request->query['model']
			: false;

		$foreign_key = (isset($this->request->query['foreign_key'])
			&& is_numeric($this->request->query['foreign_key']))
			? $this->request->query['foreign_key']
			: false;

		if (!$model || !$foreign_key) {
			throw new NotFoundException();
		}

		if (!$this->canUploadMedias($model, $foreign_key)) {
			throw new ForbiddenException();
		}

		$this->loadModel($model);
		$this->set(compact('model', 'foreign_key'));

		if (!in_array('Media', $this->$model->Behaviors()->loaded())) {
			return $this->render('nobehavior');
		}

		$id = isset($this->request->query['id']) ? $this->request->query['id'] : false;

		$medias = $this->Medias->find('all', [
			'conditions' => [
				'foreign_key' => $foreign_key,
				'model' => $model,
				'field_type !=' => 'field'
			],
			'order' => ['position ASC'],
		])->toArray();

		$medias = !empty($medias) ? $medias : [];
		$thumbID = false;

		if ($this->$model->hasField('media_id')) {
			$entity = $this->$model->get($foreign_key);
			$thumbID = $entity->media_id;
		}

		$extensions = $this->$model->medias['extensions'];
		$editor = isset($this->request->query['editor']) ? $this->request->query['editor'] : false;
		$this->set(compact('id', 'medias', 'thumbID', 'editor', 'extensions'));
	}

	/**
	 * @param int|null $id
	 *
	 * @throws \Cake\Network\Exception\NotFoundException
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function edit($id = null)
	{
		$id = $this->request->query['media_id'];
		$data = [];
		if ($id) {
			$media = $this->Medias->find()
				->where([
					'id' => $id,
				])
				->first();
			if (!$media) {
				throw new NotFoundException();
			}
			if (!$this->canUploadMedias($media->model, $media->foreign_key)) {
				throw new ForbiddenException();
			}
			$data['src'] = $media['file'];
			$data['alt'] = basename($media['file']);
			$data['class'] = '';
			$data['caption'] = $media['caption'];
			$data['editor'] = isset($this->request->query['editor']) ? $this->request->query['editor'] : false;
			$data['model'] = $media->model;
			$data['foreign_key'] = $media->foreign_key;
			$data['type'] = $media->file_type;
		}
		$data = \array_merge($data, $this->request->query);
		$this->set(compact('data'));
	}

	/**
	 * @param Cake\ORM\Entity $model
	 * @param int             $foreign_key
	 *
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function upload()
	{

		$this->autoRender = false;

		$model = (isset($this->request->query['model']))
			? $this->request->query['model']
			: false;

		$foreign_key = (isset($this->request->query['foreign_key']) && is_numeric($this->request->query['foreign_key']))
			? $this->request->query['foreign_key']
			: false;

		if (!$model || !$foreign_key) {
			throw new NotFoundException();
		}

		if (!$this->canUploadMedias($model, $foreign_key)) {
			throw new ForbiddenException();
		}

		$data = [
			'model' => $model,
			'foreign_key' => $foreign_key,
		];

		$media = $this->Medias->newEntity();

		$media = $this->Medias->patchEntity($media, $data);

		$this->Medias->setFileHandle($this->request->data['files'][0]);

		$media->tmp_name = $this->request->data['files'][0]['tmp_name'];

		if ($this->Medias->save($media, $this->request->data)) {

			$result['url'] = '/image/' . strtolower($media->model) . '/' . $media->foreign_key . '/' . $media->file;
			$result['media_list_url'] = '/image/' . strtolower($media->model) . '/' . $media->foreign_key . '/m_cropwidth_200/' . $media->file;
			$result['thumbnailUrl'] = '/image/' . strtolower($media->model) . '/' . $media->foreign_key . '/m_width_100/' . $media->file;
			$result['edit_url'] = '/media/medias/edit/' . $media->id;
			$result['delete_url'] = '/media/medias/delete/' . $media->id;
			$result['id'] = $media->id;
			$result['foreign_key'] = $media->foreign_key;
			$result['size'] = $media->size;
			$result['type'] = $media->type;
			$result['width'] = $media->width;
			$result['height'] = $media->height;
		} else {

			$errors = $media->getErrors();

			if (isset($errors['upload'])) {
				$result['error'] = $errors['upload'];
			}
		}

		echo json_encode(['files' => [0 => $result]]);
		exit();
	}

	/**
	 * @param int $id
	 *
	 * @throws \Cake\Network\Exception\BadRequestException
	 * @throws \Cake\Network\Exception\NotFoundException
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function update($id)
	{
		if (!$this->request->is('ajax')) {
			throw new BadRequestException();
		}
		$this->autoRender = false;
		if ($this->request->is([
			'put',
			'post',
		])) {
			$media = $this->Medias->find()
				->where([
					'id' => $id,
				])
				->first();
			if (!$media) {
				throw new NotFoundException();
			}
			if (!$this->canUploadMedias($media->model, $media->foreign_key)) {
				throw new ForbiddenException();
			}
			$data = [];
			$data['name'] = $this->request->data['name'] ? $this->request->data['name'] : null;
			$data['caption'] = $this->request->data['caption'] ? $this->request->data['caption'] : null;
			$media = $this->Medias->patchEntity($media, $data, [
				'validate' => false,
			]);
			$this->Medias->save($media);
		}
	}

	/**
	 * @param int $id
	 *
	 * @throws \Cake\Network\Exception\BadRequestException
	 * @throws \Cake\Network\Exception\NotFoundException
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function delete($id)
	{
		$this->autoRender = false;

		if (!$this->request->is('ajax')) {
			throw new BadRequestException();
		}

		$media = $this->Medias->find()
			->where([
				'id' => $id,
			])
			->first();

		if (!$media) {
			throw new NotFoundException();
		}

		if (!$this->canUploadMedias($media->model, $media->foreign_key)) {
			throw new ForbiddenException();
		}

		if ($this->Medias->delete($media, ['atomic' => false])) {
			$result['status'] = 'success';
		} else {
			$result['status'] = 'failure';
		}

		echo json_encode($result);
	}

	/**
	 * @param int $id
	 *
	 * @throws \Cake\Network\Exception\NotFoundException
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function thumb($id)
	{
		$media = $this->Medias->find()
			->select([
				'model',
				'foreign_key',
			])
			->where([
				'id' => $id,
			])
			->first();
		if (!$media) {
			throw new NotFoundException();
		}
		$model = $media->model;
		$foreign_key = $media->foreign_key;
		if (!$this->canUploadMedias($model, $foreign_key)) {
			throw new ForbiddenException();
		}
		$this->loadModel($model);
		$entity = $this->$model->get($foreign_key);
		$entity->media_id = $id;
		$this->$model->save($entity);
		$this->redirect([
			'action' => 'index',
			$model,
			$foreign_key,
		]);
	}

	/**
	 * @throws \Cake\Network\Exception\ForbiddenException
	 */
	public function order()
	{
		$this->viewBuilder()->layout('');
		$this->autoRender = false;
		if (!$this->request->is('ajax')) {
			throw new BadRequestException();
		}

		if (!empty($this->request->data['order'])) {
			foreach ($this->request->data['order'] as $k => $v) {
				$media = $this->Medias->get($v['id']);
				if (!$this->canUploadMedias($media->model, $media->foreign_key)) {
					throw new ForbiddenException();
				}
				$media->position = $k + 1;

				$media = $this->Medias->save($media, [
					'validate' => false,
				]);
			}
		}
	}

	public function mediaCount()
	{
		$model = (isset($this->request->query['model'])) ? $this->request->query['model'] : false;
		$foreign_key = (isset($this->request->query['foreign_key']) && is_numeric($this->request->query['foreign_key'])) ? $this->request->query['foreign_key'] : false;

		if (!$model || !$foreign_key) {
			throw new NotFoundException();
		}

		$this->autoRender = false;
		if (!$this->request->is('ajax')) {
			throw new BadRequestException();
		}

		$media_count = $this->Medias->find('all', [
			'conditions' => [
				'foreign_key' => $foreign_key,
				'model' => $model,
			],
			'order' => ['position ASC'],
		])->count();

		echo json_encode(['media_count' => $media_count]);
	}

	public function mediaFirst()
	{
		$model = (isset($this->request->query['model'])) ? $this->request->query['model'] : false;
		$foreign_key = (isset($this->request->query['foreign_key']) && is_numeric($this->request->query['foreign_key'])) ? $this->request->query['foreign_key'] : false;

		if (!$model || !$foreign_key) {
			throw new NotFoundException();
		}

		$this->autoRender = false;
		if (!$this->request->is('ajax')) {
			throw new BadRequestException();
		}

		$media_first = $this->Medias->find('all', [
			'conditions' => [
				'foreign_key' => $foreign_key,
				'model' => $model,
			],
			'order' => ['position ASC'],
		])->first();

		echo json_encode(['media_first' => $media_first->file]);
	}
}
