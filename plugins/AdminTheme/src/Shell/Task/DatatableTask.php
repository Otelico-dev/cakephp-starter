<?php

namespace AdminTheme\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;
use Cake\Utility\Inflector;

class DatatableTask extends SimpleBakeTask
{
	public $pathFragment = 'Template/';

	public function name()
	{
		return 'datatable';
	}

	public function fileName($name)
	{
		return 'Admin' . DS . ucfirst($name) . DS . 'datatables' . DS . strtolower(Inflector::underscore($name)) . '.ctp';
	}

	public function template()
	{
		return 'datatable';
	}
}
