<?php

use Migrations\AbstractMigration;

class CreateExamples extends AbstractMigration
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
		$table = $this->table('examples');
		$table->addColumn('example_category_id', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => true,
		]);
		$table->addColumn('description', 'text', [
			'default' => null,
			'null' => true,
		]);
		$table->addColumn('expiry_date', 'date', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('is_published', 'string', [
			'default' => null,
			'limit' => 5,
			'null' => false,
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
			'example_category_id',
		], [
			'name' => 'BY_EXAMPLE_CATEGORY_ID',
			'unique' => false,
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
