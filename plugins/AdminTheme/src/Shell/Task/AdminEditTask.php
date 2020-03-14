<?php

namespace AdminTheme\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;


class AdminEditTask extends SimpleBakeTask
{
	public $pathFragment = 'Template/';

	public function name()
	{
		return 'adminedit';
	}

	public function fileName($name)
	{
		return 'Admin' . DS . ucfirst($name) . DS .  'edit.ctp';
	}

	public function template()
	{
		return 'Template/edit';
	}

	public function templateData()
	{
		return ['pluralHumanName' => $this->args[0]];
	}
}
