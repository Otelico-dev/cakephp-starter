<?php

namespace App\Error\Exception;

use Cake\Core\Exception\Exception;

class FileNotFoundException extends Exception
{

	protected $_messageTemplate = 'Unable to find file : %s';
}
