<?php

namespace AdminTheme\View\Widget;

use Cake\Core\Configure;
use Cake\Database\Type;
use Cake\I18n\I18n;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;
// use DateTimeInterface;
// use DateTimeZone;

class SwitchWidget implements WidgetInterface
{

	/**
	 * Renders a bootsrap switch widget.
	 *
	 * @param array $data Data to render with.
	 * @param \Cake\View\Form\ContextInterface $context The current form context.
	 * @return string A generated select box.
	 * @throws \RuntimeException When option data is invalid.
	 */
	public function render(array $data, ContextInterface $context)
	{

		$checked = ($data['val'] == 'true') ? 'checked' : '';

		$on_text = (!empty($data['data-on']))
			? $data['data-on']
			: 'Oui';

		$off_text = (!empty($data['data-off']))
			? $data['data-off']
			: 'Non';

		$widget = <<<html
		
			<input type="checkbox" 
			id="{$data['id']}" 
			name="{$data['name']}" 
			value="true" 
			data-toggle="toggle" 
			$checked 
			data-on="$on_text" 
			data-off="$off_text" 
			/>
		
html;

		return $widget;
	}

	/**
	 * {@inheritDoc}
	 */
	public function secureFields(array $data)
	{
		if (!isset($data['name']) || $data['name'] === '') {
			return [];
		}

		return [];
	}
}
