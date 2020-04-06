<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Examples Model
 *
 * @property \App\Model\Table\ExampleCategoriesTable&\Cake\ORM\Association\BelongsTo $ExampleCategories
 *
 * @method \App\Model\Entity\Example get($primaryKey, $options = [])
 * @method \App\Model\Entity\Example newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Example[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Example|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Example saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Example patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Example[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Example findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExamplesTable extends Table
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

		$this->setTable('examples');
		$this->setDisplayField('title');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('ExampleCategories', [
			'foreignKey' => 'example_category_id',
			'joinType' => 'INNER',
		]);

		$this->addBehavior('Translate', [
			'fields' => [
				'title',
				'description'
			]
		]);

		$this->addBehavior('AdminTheme.Positionable');
		$this->addBehavior('AdminTheme.Publishable');

		$this->addBehavior('Media.Media');
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
			->maxLength('title', 255)
			->allowEmptyString('title');

		$validator
			->scalar('description')
			->allowEmptyString('description');

		$validator
			->date('expiry_date')
			->requirePresence('expiry_date', 'create')
			->notEmptyDate('expiry_date');

		$validator
			->scalar('is_published')
			->maxLength('is_published', 5)
			->requirePresence('is_published', 'create')
			->notEmptyString('is_published');

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['example_category_id'], 'ExampleCategories'));

		return $rules;
	}
}
