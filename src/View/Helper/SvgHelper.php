<?php

namespace App\View\Helper;

use Cake\View\Helper;

class SvgHelper extends Helper
{

	public function display($file)
	{

		if (!file_exists(WWW_ROOT . $file)) {
			return false;
		}

		$svg = file_get_contents(WWW_ROOT . $file);
		$svg = $this->compressSvg($svg);
		return $svg;
	}

	protected function compressSvg($svg)
	{
		$svg = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $svg);
		$svg = preg_replace('/<!--.*-->/', '', $svg);
		$svg = preg_replace('/<g>[\n\r\s]*<\/g>/', '', $svg);
		$svg = preg_replace('/\n/', ' ', $svg);
		$svg = preg_replace('/\t/', ' ', $svg);
		$svg = preg_replace('/\s\s+/', ' ', $svg);
		$svg = str_replace('> <', '><', $svg);
		$svg = str_replace(';"', '"', $svg);
		$svg = preg_replace('/fill:#[A-Za-z0-9]+;/', '', $svg);
		$svg = preg_replace('/fill="#[A-Za-z0-9]+"/', '', $svg);


		return $svg;
	}
}
