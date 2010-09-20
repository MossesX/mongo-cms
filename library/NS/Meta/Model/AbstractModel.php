<?php

namespace NS\Meta\Model;

use \NS\Meta\Registry;
use \NS\Meta\Model\SetterStrategy\Factory;

abstract class AbstractModel extends \NS\Core\Cls\Fluent
{
	/**
	 * Call
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		if (isset($arguments[0]))
		{
			$relModel = $arguments[0];
			if (substr($name, 0, 3) == 'set')
			{
				// Meta registry
				$registry = Registry::getInstance();

				// Formatting property
				$property = substr($name, 3);
				$property = strtolower($property[0]) . substr($property, 1);

				// Retrieving relation for property
				$rel = $registry->getRelation($this, $property);
				if ($rel)
				{
					Factory::create($this, $relModel, $rel)->set();
					return $this;
				}
			}
		}
		return parent::__call($name, $arguments);
	}

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public abstract function fromArray(array $array);

	/**
	 * Converting model to array
	 *
	 * @return array
	 */
	public abstract function toArray();

	/**
	 * Sets property
	 *
	 * @param string $property
	 * @param mixed $value
	 * @return AbstractModel
	 */
	public function setProperty($property, $value)
	{
		if ($property == 'property') return $this;
		return call_user_func(array($this, 'set'.ucfirst($property)), $value);
	}

	/**
	 * Retrieves property value
	 * 
	 * @param string $property
	 * @return mixed
	 */
	public function getProperty($property)
	{
		if ($property == 'property') return null;
		return call_user_func(array($this, 'get'.ucfirst($property)));
	}

	/**
	 * Sets property without calling set<Property> method
	 *
	 * @param string $property
	 * @param mixed $value
	 * @return AbstractModel
	 */
	public function setPropertyExact($property, $value)
	{
		$property = '_' . $property;
		$this->$property = $value;
		return $this;
	}
}
