<?php

use Migrations\AbstractMigration;

class CreatePages extends AbstractMigration
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
		$table = $this->table('pages');
		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 2000,
			'null' => false,
		]);
		$table->addColumn('content', 'text', [
			'default' => null,
			'null' => true,
		]);
		$table->addColumn('is_published', 'string', [
			'default' => null,
			'limit' => 5,
			'null' => true,
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
			'is_published',
		], [
			'name' => 'BY_IS_PUBLISHED',
			'unique' => false,
		]);
		$table->create();
	}
}
