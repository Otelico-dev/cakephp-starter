<?php

namespace AdminTheme\Model\Entity;

use Cake\ORM\Entity;

/**
 * MetaData Entity
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $introduction
 * @property string|null $outroduction
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $controller
 * @property string|null $action
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class MetaData extends Entity
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
		'title' => true,
		'introduction' => true,
		'outroduction' => true,
		'meta_title' => true,
		'meta_description' => true,
		'controller' => true,
		'action' => true,
		'created' => false,
		'modified' => false,
	];
}
