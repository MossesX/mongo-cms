<?php

namespace NS\Core\Cls\Exception;

use \NS\Core\Exception;

class PropertyNotFound extends Exception
{
	/**
	 * Constructor
	 *
	 * @param mixed $className class name or object
	 * @param string $property
	 */
	public function __construct($className, $property)
	{
		if (!is_string($className))
			$className = get_class($className);
		
		parent::__construct("Property {$className}::{$property} doesn't exist");
	}
}

