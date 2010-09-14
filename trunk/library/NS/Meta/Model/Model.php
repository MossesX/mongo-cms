<?php

namespace NS\Meta\Model;

use \NS\Meta\Reference;

abstract class Model extends \NS\Meta\Model
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
}
