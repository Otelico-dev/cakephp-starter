<?php

use Migrations\AbstractMigration;

class AddPositionToVehicles extends AbstractMigration
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
		$table = $this->table('vehicles');
		$table->addColumn('position', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
			'after' => 'name'
		]);
		$table->update();
	}
}
