<?php

namespace NS\Core\Cls\Exception;

use \NS\Core\Exception;

class MethodNotFound extends Exception
{
	/**
	 * Constructor
	 *
	 * @param mixed $className class name or object
	 * @param string $method
	 */
	public function __construct($className, $method)
	{
		if (!is_string($className))
			$className = get_class($className);

		parent::__construct("Method {$className}::{$method} doesn't exist");
	}
}

