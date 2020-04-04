<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace AdminTheme\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

/**
 * Input widget class for generating a file upload control.
 *
 * This class is intended as an internal implementation detail
 * of Cake\View\Helper\FormHelper and is not intended for direct use.
 */
class FileWidget implements WidgetInterface
{


	/**
	 * Render a file upload form widget.
	 *
	 * Data supports the following keys:
	 *
	 * - `name` - Set the input name.
	 * - `escape` - Set to false to disable HTML escaping.
	 *
	 * All other keys will be converted into HTML attributes.
	 * Unlike other input objects the `val` property will be specifically
	 * ignored.
	 *
	 * @param array $data The data to build a file input with.
	 * @param \Cake\View\Form\ContextInterface $context The current form context.
	 * @return string HTML elements.
	 */
	public function render(array $data, ContextInterface $context)
	{
		// $data += [
		// 	'name' => '',
		// 	'escape' => true,
		// 	'templateVars' => [],
		// ];
		// debug($data);


		return $this->getHtml($data);
	}

	protected function getHtml(array $data)
	{
		$html = <<<html
			<div class="custom-file">
				<input type="file" id="{$data['id']}" name="{$data['name']}" value="true" class="custom-file-input" />
				<label class="custom-file-label">Choisir fichier</label>
			</div>		
html;
		$html .= $this->getFile($data);
		return $html;
	}

	protected function getFile(array $data)
	{

		if (empty($data['val']) || empty($data['val']['file'])) {
			return;
		}

		if ($this->isImage($data)) {
			return $this->getImageHtml($data);
		}

		return $this->getFileHtml($data);
	}

	protected function isImage(array $data)
	{

		if (
			!empty($data['val']['file_type'])
			&& in_array($data['val']['file_type'], ['jpg', 'png', 'gif'])
		) {
			return true;
		}

		return false;
	}

	protected function getImageHtml(array $data)
	{

		$html = <<<html
			<img src="/image/{$data['val']['file_path']}/m_cropwidth_200/{$data['val']['file']}" />
html;
		return $html;
	}

	protected function getFileHtml(array $data)
	{
		$html = <<<html
			<p>Fichier : <a href="/image/{$data['val']['file_path']}/{$data['val']['file']}" />{$data['val']['file']}</a></p>
html;
		return $html;
	}

	/**
	 * {@inheritDoc}
	 */
	public function secureFields(array $data)
	{
		$fields = [];
		foreach (['name', 'type', 'tmp_name', 'error', 'size'] as $suffix) {
			$fields[] = $data['name'] . '[' . $suffix . ']';
		}

		return $fields;
	}
}
