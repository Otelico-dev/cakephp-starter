<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Example Entity
 *
 * @property int $id
 * @property int $example_category_id
 * @property string|null $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate $expiry_date
 * @property string $is_published
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ExampleCategory $example_category
 */
class Example extends Entity
{
	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * Note that when '*' is set to true, this allows all unspecified fields to
	 * be mass assigned. For security purposes, it is advised to set '*' to false
	 * (or remove it), and explicitly make individual fields accessible as needed.
	 *
	 * @var array
	 */
	protected $_accessible = [
		'example_category_id' => true,
		'title' => true,
		'description' => true,
		'expiry_date' => true,
		'is_published' => true,
		'position' => true,
		'created' => true,
		'modified' => true,
		'example_category' => true,
		'_translations' => true
	];
}
