<?php

namespace NS\Meta\Property;

use \NS\Core\Cls\Fluent\Options;

abstract class AbstractProperty extends Options
{
	protected $_property;
	protected $_key;
	protected $_type;

	/**
	 * Key getter
	 *
	 * @return string
	 */
	public function getKey()
	{
		return $this->_key ? $this->_key : $this->_property;
	}

	/**
	 * Property getter
	 * 
	 * @return string
	 */
	public function getProperty()
	{
		return $this->_property ? $this->_property : $this->_key;
	}
}
