<?php

use Migrations\AbstractMigration;

class CreateMedias extends AbstractMigration
{
	/**
	 * Change Method.
	 *
	 * More information on this method is available here:
	 * http://docs.phinx.org/en/latest/migrations.html#the-change-method
	 * @return void
	 */
	public function change()
	{
		$table = $this->table('medias');
		$table->addColumn('model', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('foreign_key', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->addColumn('file', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('file_type', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('name', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('field_type', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);

		$table->addColumn('position', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->addColumn('caption', 'string', [
			'default' => null,
			'limit' => 2000,
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
			'model',
		], [
			'name' => 'BY_MODEL',
			'unique' => false,
		]);
		$table->addIndex([
			'foreign_key',
		], [
			'name' => 'BY_FOREIGN_KEY',
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
