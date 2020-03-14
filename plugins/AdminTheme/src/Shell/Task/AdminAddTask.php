<?php

namespace AdminTheme\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;


class AdminAddTask extends SimpleBakeTask
{
	public $pathFragment = 'Template/';

	public function name()
	{
		return 'adminadd';
	}

	public function fileName($name)
	{
		return 'Admin' . DS . ucfirst($name) . DS .  'add.ctp';
	}

	public function template()
	{
		return 'Template/add';
	}

	public function templateData()
	{
		return ['pluralHumanName' => $this->args[0]];
	}
}
