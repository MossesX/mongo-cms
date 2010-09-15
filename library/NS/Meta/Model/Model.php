<?php

namespace NS\Meta\Model;

use \NS\Meta\Property\Reference;

abstract class Model extends AbstractModel
{
	/**
	 * References
	 * @var array
	 */
	protected $_references = array();

	/**
	 * Add reference
	 *
	 * @param Reference
	 * @return Model
	 */
	public function addReference(Reference $reference)
	{
		$this->_references[$reference->getKey()] = $reference;
		return $this;
	}

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public function fromArray(array $array)
	{
		// References
		foreach ($this->_references as $key => $reference)
			if (isset($array[$key]))
				$this->setProperty($reference->getProperty(), $reference->fromString($array[$key]));
	}

	/**
	 * Converting model to array
	 *
	 * @return array
	 */
	public function toArray()
	{
		$res = array();

		// References
		foreach ($this->_references as $key => $reference)
			$res[$key] = $reference->toString($this->getProperty($key));

		return $res;
	}
}
