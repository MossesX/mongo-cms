<?php

namespace NS\Core\Cls;

use \NS\Core\Cls\Exception;

abstract class Fluent
{
	/**
	 * Creation
	 *
	 * @return Fluent
	 */
	public static function create()
	{
		return new static();
	}

	/**
	 * Call
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 *
	 * @thows \NS\Core\Cls\Exception\PropertyNotFound
	 * @thows \NS\Core\Cls\Exception\MethodNotFound
	 */
	public function __call($name, $arguments)
	{
		$prefix = substr($name, 0, 3);
		if ($prefix == 'set' || $prefix == 'get')
		{
			$property = substr($name, 3);
			$property = '_' . strtolower($property[0]) . substr($property, 1);
			if (property_exists($this, $property))
			{
				if ($prefix == 'set')
				{
					$this->$property = $arguments[0];
					return $this;
				}
				elseif ($prefix == 'get')
					return $this->$property;
			}
			throw new Exception\PropertyNotFound($this, $property);
		}

		throw new Exception\MethodNotFound($this, $name);
	}
}
