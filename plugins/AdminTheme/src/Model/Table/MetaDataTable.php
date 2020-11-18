<?php

namespace AdminTheme\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * MetaData Model
 *
 * @method \AdminTheme\Model\Entity\MetaData get($primaryKey, $options = [])
 * @method \AdminTheme\Model\Entity\MetaData newEntity($data = null, array $options = [])
 * @method \AdminTheme\Model\Entity\MetaData[] newEntities(array $data, array $options = [])
 * @method \AdminTheme\Model\Entity\MetaData|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminTheme\Model\Entity\MetaData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminTheme\Model\Entity\MetaData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminTheme\Model\Entity\MetaData[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminTheme\Model\Entity\MetaData findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MetaDataTable extends Table
{
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->setTable('meta_data');
		$this->setDisplayField('title');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		if (Configure::read('I18n')) {
			$this->addBehavior('Translate', [
				'fields' => [
					'title',
					'introduction',
					'outroduction',
					'meta_title',
					'meta_description'
				]
			]);
		}
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('title')
			->maxLength('title', 1000)
			->allowEmptyString('title');

		$validator
			->scalar('introduction')
			->allowEmptyString('introduction');

		$validator
			->scalar('outroduction')
			->allowEmptyString('outroduction');

		$validator
			->scalar('meta_title')
			->maxLength('meta_title', 1000)
			->allowEmptyString('meta_title');

		$validator
			->scalar('meta_description')
			->maxLength('meta_description', 1000)
			->allowEmptyString('meta_description');

		$validator
			->scalar('controller')
			->maxLength('controller', 200)
			->requirePresence('controller', 'create')
			->notEmptyString('controller');

		$validator
			->scalar('action')
			->maxLength('action', 200)
			->allowEmptyString('action');

		return $validator;
	}
}
