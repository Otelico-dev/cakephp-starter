<?php

namespace Media\View\Helper;

use Cake\View\Helper;

class ImageHelper extends Helper
{

	public $helpers = ['Html'];

	public function display($image, array $options)
	{
		return $this->Html->image(
			$this->getImagePath($image, $options)
		);
	}

	public function getImagePath($image, array $options)
	{
		$image_path = '/image' . $image->file_path;
		if (!empty($options['manipulation'])) {
			$image_path .= 'm_' . $options['manipulation']['type'] . '_' . $options['manipulation']['value'] . '/';
		}
		$image_path .= $image->file;

		return $image_path;
	}
}
