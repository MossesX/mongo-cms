<?php

namespace NS\Meta\Property;

use \NS\Core\Cls\Fluent\Options;

abstract class AbstractProperty extends Options
{
	/**
	 * Property
	 * @var string
	 */
	protected $_property;

	/**
	 * Array key
	 * @var string
	 */
	protected $_key;

	/**
	 * Property type
	 * @var mixed
	 */
	protected $_type;

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
