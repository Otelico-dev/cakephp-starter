<?php

use Migrations\AbstractMigration;

class CreateMetaData extends AbstractMigration
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
		$table = $this->table('meta_data');
		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 1000,
			'null' => true,
		]);
		$table->addColumn('introduction', 'text', [
			'default' => null,
			'null' => true,
		]);
		$table->addColumn('outroduction', 'text', [
			'default' => null,
			'null' => true,
		]);
		$table->addColumn('meta_title', 'string', [
			'default' => null,
			'limit' => 1000,
			'null' => true,
		]);
		$table->addColumn('meta_description', 'string', [
			'default' => null,
			'limit' => 1000,
			'null' => true,
		]);
		$table->addColumn('controller', 'string', [
			'default' => null,
			'limit' => 200,
			'null' => false,
		]);
		$table->addColumn('action', 'string', [
			'default' => null,
			'limit' => 200,
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
		$table->create();
	}
}
