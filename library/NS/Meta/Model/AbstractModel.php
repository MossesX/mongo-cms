<?php

namespace NS\Meta\Model;

abstract class AbstractModel extends \NS\Core\Cls\Fluent
{
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
		return call_user_func(array($this, 'get'.ucfirst($property)));
	}
}
