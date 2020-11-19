<?php
require "../vendor/autoload.php";

use Verot\Upload\Upload;

/**
 * File
 *
 */
class File
{

	var $ds = '/'; // Holds directory seperator
	var $handle; // Holds upload object
	var $client_name; // Holds client name
	var $uploads_dir; // Holds nmae of uploads folder

	var $offset; // Holds offset for expires header

	var $cache = true; // If true image will be cached
	var $cache_dir; // Holds name of cache folder

	var $filename; // Holds name of file to display
	var $width = false; // Holds width of image
	var $crop_width = false; // Holds width to crop image to
	var $height = false; // Holds specific height of image
	var $max_height = false; // Holds max height of image to set
	var $force = false;
	var $jpg_quality = 60;

	/**
	 * beforeFilter method
	 *
	 * @return void
	 */

	function __construct()
	{

		$this->uploads_dir = '../uploads' . $this->ds;

		if (!is_dir($this->uploads_dir)) {
			exit();
		}

		$this->cache_dir = 'image' . $this->ds;
		$this->offset = 720 * 60 * 60;
	}

	/**
	 * Displays uploaded file, makes copy in cache if necessary
	 *
	 * @return void
	 */
	public function serveFile()
	{

		if (isset($_GET['type']) && $_GET['type'] == 'upload') $this->cache = false;

		if (!$this->setFilename()) {
			return false;
		}

		$this->setParameters();

		$this->handle = new Upload($this->uploads_dir . $this->filepath . $this->ds . $this->filename);

		if ($this->handle->uploaded) {

			if ($this->width) $this->setWidth();

			if ($this->resizecrop) $this->setResizeCrop();

			if ($this->crop_width) $this->setCropWidth();

			if ($this->max_height) $this->setMaxHeight();

			$this->display();

			if ($this->cache) $this->cache();

			exit();
		} else {
			echo 'file not found';
		}
	}

	/**
	 * Sets name of file to display
	 */
	private function setFilename()
	{

		if (empty($_GET['uri'])) return false;

		$uri_parts = explode('/', $_GET['uri']);

		foreach ($uri_parts as $key => $value) {

			if ($value == '' || $value == 'image') {
				unset($uri_parts[$key]);
			}

			if (substr($value, 0, 2) === 'm_') {

				$this->manipulation = explode('_', $value);
				unset($uri_parts[$key]);
			}
		}

		$uri_parts = array_values($uri_parts);

		$this->filename = $uri_parts[sizeof($uri_parts) - 1];
		unset($uri_parts[sizeof($uri_parts) - 1]);

		$this->filepath = implode('/', $uri_parts);

		$this->cache_dir = $this->cache_dir . $this->filepath . $this->ds;

		return true;
	}

	/**
	 * Sets paremeters for image manipulation
	 */
	private function setParameters()
	{

		if (isset($this->manipulation[1])) {

			switch ($this->manipulation[1]) {
				case 'width':
					$this->setWidthManipulation();
					break;
				case 'resizecrop':
					$this->setResizeCropManipulation();
					break;
				case 'cropwidth':
					$this->setCropWidthManipulation();
					break;
			}

			$this->cache_dir = $this->cache_dir . implode('_', $this->manipulation) . '/';
		}
	}

	protected function setWidthManipulation()
	{

		if (isset($this->manipulation[2]) && is_numeric($this->manipulation[2])) {

			$this->width = $this->round_image_size($this->manipulation[2]);
		}
	}

	protected function setResizeCropManipulation()
	{

		if (isset($this->manipulation[2]) && is_numeric($this->manipulation[2])) {

			$this->resizecrop = $this->round_image_size($this->manipulation[2]);
		}
	}

	protected function setCropWidthManipulation()
	{

		if (isset($this->manipulation[2]) && is_numeric($this->manipulation[2])) {
			$this->crop_width = $this->round_image_size($this->manipulation[2]);
		}
	}


	/**
	 * Sets image width
	 *
	 */
	private function setWidth()
	{

		if ($this->handle->image_src_x > $this->width) {
			$this->handle->image_resize = true;
			$this->handle->image_x = $this->width;
			$this->handle->image_ratio_y = true;
		} else {
			$this->handle->image_resize = true;
			$this->handle->image_x = $this->handle->image_src_x;
			$this->handle->image_ratio_y = true;
		}
	}

	protected function setResizeCrop()
	{

		$height = $this->handle->image_src_y - $this->handle->image_src_x;
		$this->handle->image_resize = true;
		$this->handle->image_precrop = '0 0 ' . $height . ' 0';
		$this->handle->image_x = $this->resizecrop;
		$this->handle->image_y = 300;
	}

	/**
	 * Sets crop width
	 *
	 */
	private function setCropWidth()
	{

		if (!$this->height) {
			$this->height = round(($this->crop_width / 4) * 3);
		}

		if ($this->force == true || $this->handle->image_src_x > $this->crop_width) {
			$this->handle->image_resize = true;
			$this->handle->image_ratio_crop = true;
			$this->handle->image_x = $this->crop_width;
			$this->handle->image_y = $this->height;
		}
	}

	/**
	 * Sets max height
	 */
	private function setMaxHeight()
	{

		if ($this->handle->image_src_y > $this->max_height) {
			$this->handle->image_resize = true;
			$this->handle->image_y = $this->max_height;
			$this->handle->image_ratio_x = true;
		}
	}

	/**
	 * Sets crop coordinates
	 */
	private function setCropCoordinates()
	{
		// if (isset($_GET['crop_coordinates'])) {

		// 	$ratio =  (  $handle->image_src_x  / $handle->image_src_y);

		// 	$handle->image_x = $_GET['slider_x'];
		// 	$handle->image_resize          = true;

		// 	$handle->image_y         =  round($handle->image_x / $ratio);

		// 	$y1 = $_GET['y1'];
		// 	$x1 = $_GET['x1'];
		// 	$y2 = $_GET['y2'];
		// 	$x2 = $_GET['x2'];

		// 	$handle->image_crop = array($y1, $x2, $y2, $x1);
		// }
	}

	/**
	 * Displays processed image
	 *
	 */
	private function display()
	{

		header('Content-type: ' . $this->handle->file_src_mime);
		header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $this->offset));
		echo $this->handle->Process();
	}

	/**
	 * Caches processed image
	 * @return void
	 */
	private function cache()
	{

		if ($this->width) {
			$this->setWidth();
		}

		if ($this->crop_width) {
			$this->setCropWidth();
		}

		if ($this->handle->file_is_image) {

			switch ($this->handle->image_src_type) {
				case 'jpg':
					$this->handle->jpeg_quality = $this->jpg_quality;
					break;
			}
		}

		$this->handle->process($this->cache_dir);
	}

	/**
	 * Rounds image size to multiple of 100 or 50 if less than 100. Limit at 2500
	 * @param  int $num Number to round up
	 * @return int      Rounded number
	 */
	private function round_image_size($num)
	{

		if ($num > 2500) $num = 2500;

		$multiple = 100;
		if ($num < $multiple) {
			$multiple = $multiple / 2;
		}

		if ($multiple < 50) $multiple = 50;
		return round($num / $multiple, 0) * $multiple;
	}
}


$File = new File;
$File->serveFile();
exit();
