<?php

namespace Media\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

class MediaHelper extends Helper
{

	/**
	 * Default Helpers
	 *
	 * @var array $helpers
	 */
	public $helpers = [
		'Html',
		'Form',
		'Url'
	];

	public $explorer = false;

	/**
	 * Constructor
	 *
	 * @param \Cake\View\View $View
	 *            The View this helper is being attached to.
	 * @param array $config
	 *            Configuration settings for the helper.
	 */
	public function __construct(View $View, array $config = [])
	{
		parent::__construct($View, $config);
	}


	/**
	 *
	 * @param string $ref
	 *            Table name
	 * @param int $refId
	 *            Entity ID
	 * @param array $options Array of options           
	 * @return string
	 */
	public function displayImageUploadBlock($model, $foreign_key, $options = array())
	{

		$height = '500px';
		if (!empty($options['height'])) {
			$height = $options['height'];
		}

		return '<iframe src="' . $this->Url->build("/media/medias/index?model=$model&foreign_key=$foreign_key") . '" style="width:100%; height: ' . $height . '; border: none;" id="medias-' . $model . '-' . $foreign_key . '"></iframe>';
	}

	public function fileInput($entity, $field)
	{

		$html = '';

		if (!empty($entity->media[0])) {
			$html .= '<div class="media__img_preview" style="postion:relative; margin-bottom:10px;">';

			$html .= $this->Html->link(
				$this->Html->image('/image/' . $entity->media[0]->file_path . 'm_cropwidth_300/' . $entity->media[0]->file, ['style' => 'max-width:100%']) .
					'<span class="delete-media-overlay" style="display:block;position:absolute; top:0; right:0; bottom:0; left:0; background: rgba(0,0,0,.5); opacity:0; transition: all 0.2s ease-out;"><span style="color: #fff; font-size: 48px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%); ">&times;</span></span>',
				[
					'plugin' => 'Media',
					'controller' => 'medias',
					'action' => 'delete',
					$entity->media[0]->id,
					'prefix' => false
				],
				[
					'escape' => false,
					'class' => 'delete-media',
					'style' => 'display:block;position:relative',
					'data-confirmation_text' => __d('medias', 'Are you sure you want to delete?')
				]
			);

			$html .= '</div>';
		}

		$html .= $this->Form->file($field);

		$this->Html->script('/media/js/fileInput.js', [
			'block' => true
		]);

		return $html;
	}

	/**
	 * Converts filesize in bytes to human readable form
	 * @param  int  $bytes    Number of bytes to convert
	 * @param  integer $decimals Number of decimal places to include
	 * @return string           Human readable format
	 */
	function human_filesize($bytes, $decimals = 2)
	{
		$size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
	}
}
