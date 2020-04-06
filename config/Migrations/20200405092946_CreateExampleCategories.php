<?php

use Migrations\AbstractMigration;

class CreateExampleCategories extends AbstractMigration
{
	/**
	 * Change Method.
	 *
	 * More information on this method is available here:
	 * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
	 * @return void
	 */
	public function change()
	{
		$table = $this->table('example_categories');
		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => true,
		]);
		$table->addColumn('position', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->addColumn('created', 'datetime', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('modified', 'datetime', [
			'default' => null,
			'null' => false,
		]);
		$table->addIndex([
			'position',
		], [
			'name' => 'BY_POSITION',
			'unique' => false,
		]);
		$table->create();
	}
}
