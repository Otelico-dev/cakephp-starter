<?php

namespace AdminTheme\View\Widget;

use Cake\Core\Configure;
use Cake\Database\Type;
use Cake\I18n\I18n;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;
// use DateTimeInterface;
// use DateTimeZone;

class DatePickerWidget implements WidgetInterface
{

	/**
	 * Renders a date time widget.
	 *
	 * @param array $data Data to render with.
	 * @param \Cake\View\Form\ContextInterface $context The current form context.
	 * @return string A generated select box.
	 * @throws \RuntimeException When option data is invalid.
	 */
	public function render(array $data, ContextInterface $context)
	{

		$id = $data['id'];
		$name = $data['name'];
		$val = $data['val'];
		$type = $data['type'];
		$required = $data['required'] ? 'required' : '';
		$disabled = isset($data['disabled']) && $data['disabled'] ? 'disabled' : '';
		$div_class = 'input-group';
		$input_class = 'form-control datepicker';

		if ($context->hasError($data['name'])) {
			$input_class .= ' is-invalid';
			$div_class .= ' is-invalid';
		}

		if (
			$val
			&& ($val instanceof \Cake\I18n\FrozenDate || $val instanceof \DateTime)
		) {
			$val = $val->format($type === 'date' ? 'Y-m-d' : 'Y-m-d H:i:s');
		}


		$icon = $type === 'time'
			? 'time'
			: 'calendar';

		$widget = <<<html
            <div 
            class="$div_class"
            >
            <input
                type="text"
                class="$input_class"
                name="$name"
                value="$val"
                id="$id"
                data-value="$val"    
html;


		$widget .= <<<html
                    $required
                    $disabled
                />
                <label for="$id" class="input-group-append">
                    <span class="input-group-text fa fa-$icon"></span>
                </label>
            </div>
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

		return [$data['name']];
	}
}
