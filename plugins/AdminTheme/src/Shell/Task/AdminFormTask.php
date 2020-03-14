<?php

namespace AdminTheme\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class AdminFormTask extends SimpleBakeTask
{
	public $pathFragment = 'Template/';
	protected $controllerName;
	protected $modelName;

	public function name()
	{
		return 'adminform';
	}

	public function fileName($name)
	{
		return 'Admin' . DS . ucfirst($name) . DS . 'form' . ucfirst($name) . '.ctp';
	}

	public function template()
	{
		return 'Template/form';
	}

	public function templateData()
	{
		// dd($this->args[0]);
		$this->controllerName = $this->args[0];
		$this->modelName = 'Members';
		$vars = $this->_loadController();

		return $vars;
	}

	protected function _loadController()
	{
		if (TableRegistry::getTableLocator()->exists($this->modelName)) {
			$modelObject = TableRegistry::getTableLocator()->get($this->modelName);
		} else {
			$modelObject = TableRegistry::getTableLocator()->get($this->modelName, [
				'connectionName' => $this->connection,
			]);
		}

		$namespace = Configure::read('App.namespace');

		$primaryKey = (array) $modelObject->getPrimaryKey();
		$displayField = $modelObject->getDisplayField();
		$singularVar = $this->_singularName($this->controllerName);
		$singularHumanName = $this->_singularHumanName($this->controllerName);
		$schema = $modelObject->getSchema();
		$fields = $schema->columns();
		$modelClass = $this->modelName;

		list(, $entityClass) = namespaceSplit($this->_entityName($this->modelName));
		$entityClass = sprintf('%s\Model\Entity\%s', $namespace, $entityClass);
		if (!class_exists($entityClass)) {
			$entityClass = EntityInterface::class;
		}
		// $associations = $this->_filteredAssociations($modelObject);
		// $keyFields = [];
		// if (!empty($associations['BelongsTo'])) {
		// 	foreach ($associations['BelongsTo'] as $assoc) {
		// 		$keyFields[$assoc['foreignKey']] = $assoc['variable'];
		// 	}
		// }

		$pluralVar = Inflector::variable($this->controllerName);
		$pluralHumanName = $this->_pluralHumanName($this->controllerName);

		return compact(
			'modelObject',
			'modelClass',
			'entityClass',
			'schema',
			'primaryKey',
			'displayField',
			'singularVar',
			'pluralVar',
			'singularHumanName',
			'pluralHumanName',
			'fields',
			'associations',
			'keyFields',
			'namespace'
		);
	}
}
