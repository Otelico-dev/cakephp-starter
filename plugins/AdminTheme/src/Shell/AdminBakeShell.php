<?php

namespace AdminTheme\Shell;

use Cake\Console\Shell;

class AdminBakeShell extends Shell
{

	// public $tasks = array('Datatable');

	public function getOptionParser()
	{
		// Get an empty parser from the framework.
		$parser = parent::getOptionParser();

		// Define your options and arguments.
		$parser->addOption('table', ['help' => 'The table to bake']);
		// Return the completed parser
		return $parser;
	}


	public function main()
	{

		if (empty($this->params['table'])) {
			$this->abort('No table selected');
		}

		$this->dispatchShell('bake all --theme=AdminTheme --prefix=Admin ' . $this->params['table']);
		$this->dispatchShell('bake datatable --theme=AdminTheme ' . $this->params['table']);
		$this->dispatchShell('bake admin_form --theme=AdminTheme ' . $this->params['table']);
		$this->dispatchShell('bake admin_add --theme=AdminTheme ' . $this->params['table']);
		$this->dispatchShell('bake admin_edit --theme=AdminTheme ' . $this->params['table']);
	}
}
