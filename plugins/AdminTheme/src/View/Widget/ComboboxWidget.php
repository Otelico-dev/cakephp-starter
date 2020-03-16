<?php

namespace AdminTheme\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

class ComboboxWidget implements WidgetInterface
{

	public function render(array $data, ContextInterface $context)
	{
		$options['class'] += ' combobox';
		// return parent::select($data['name'], $data['options'],  $data['attributes']);
	}
}
