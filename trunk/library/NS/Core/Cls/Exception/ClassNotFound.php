<?php

namespace NS\Core\Cls\Exception;

use \NS\Core\Exception;

class ClassNotFound extends Exception
{
	/**
	 * Constructor
	 *
	 * @param string $className
	 * @param string $method
	 */
	public function __construct($className)
	{
		parent::__construct("Class {$className} doesn't exist");
	}
}

