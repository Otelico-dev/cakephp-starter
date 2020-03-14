<?php

namespace AdminTheme\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;

class DatatableTask extends SimpleBakeTask
{
	public $pathFragment = 'Template/';

	public function name()
	{
		return 'datatable';
	}

	public function fileName($name)
	{
		return 'Admin' . DS . ucfirst($name) . DS . 'datatables' . DS . strtolower($name) . '.ctp';
	}

	public function template()
	{
		return 'datatable';
	}
}
