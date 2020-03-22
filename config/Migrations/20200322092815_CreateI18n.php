<?php

use Migrations\AbstractMigration;

class CreateI18n extends AbstractMigration
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
		$table = $this->table('i18n');
		$table->addColumn('locale', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
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
		$table->addColumn('field', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('content', 'text', [
			'default' => null,
			'null' => false,
		]);
		$table->addIndex(
			[
				'locale',
				'model',
				'foreign_key',
				'field'
			],
			[
				'unique' => true,
				'name' => 'I18N_LOCALE_FIELD'
			]
		);

		$table->addIndex(
			[
				'model',
				'foreign_key',
				'field'
			],
			[
				'name' => 'I18N_FIELD'
			]
		);
		$table->create();
	}
}
