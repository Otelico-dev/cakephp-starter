<?php

namespace App\Error\Exception;

use Cake\Core\Exception\Exception;

class FileWriteException extends Exception
{

	protected $_messageTemplate = 'Unable to write file or folder : %s';
}
