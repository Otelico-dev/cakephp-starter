<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExampleCategories Model
 *
 * @property \App\Model\Table\ExamplesTable&\Cake\ORM\Association\HasMany $Examples
 *
 * @method \App\Model\Entity\ExampleCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExampleCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExampleCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExampleCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExampleCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExampleCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExampleCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExampleCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExampleCategoriesTable extends Table
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

		$this->setTable('example_categories');
		$this->setDisplayField('title');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('Examples', [
			'foreignKey' => 'example_category_id',
		]);

		$this->addBehavior('Translate', [
			'fields' => [
				'title'
			]
		]);

		$this->addBehavior('AdminTheme.Positionable');
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

		// $validator
		// 	->scalar('title')
		// 	->maxLength('title', 255)
		// 	->requirePresence('title', 'create')
		// 	->notEmptyString('title');



		return $validator;
	}
}
