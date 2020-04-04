<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace AdminTheme\View;

use LilHermit\Bootstrap4\View\BootstrapViewTrait;
use App\View\AppView;
use AdminTheme\View\Widget\DatePickerWidget;
use AdminTheme\View\Widget\SwitchWidget;
use AdminTheme\View\Widget\FileWidget;


// use AdminTheme\View\Widget\ComboboxWidget;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AdminAppView extends AppView
{
	use BootstrapViewTrait;
	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading helpers.
	 *
	 * e.g. `$this->loadHelper('Html');`
	 *
	 * @return void
	 */
	public function initialize()
	{
		// parent::initialize();

		$this->loadHelper('Html', ['className' => 'LilHermit/Bootstrap4.Html']);
		$this->loadHelper('Flash', ['className' => 'LilHermit/Bootstrap4.Flash']);
		$this->loadHelper('Form', [
			'className' => 'AdminTheme.AdminForm',
			'templates' => [
				'select' => '<select name="{{name}}" class="selectize" {{attrs}}>{{content}}</select>',
			]
		]);

		$this->loadHelper('Paginator', ['className' => 'LilHermit/Bootstrap4.Paginator']);

		$this->loadHelper('AdminTheme.Configure');
		$this->loadHelper('DataTables.DataTables');
		$this->loadHelper('AdminTheme.DtReorder');

		$datePickerWidget = new DatePickerWidget($this->Form->templater());
		$this->Form->addWidget('datepicker', $datePickerWidget);


		$this->Form->addWidget('switch', new SwitchWidget($this->Form->templater()));

		$this->Form->addWidget('file', new FileWidget($this->Form->templater()));

		$this->loadHelper('Image', [
			'className' => 'Media.Image'
		]);
	}
}
