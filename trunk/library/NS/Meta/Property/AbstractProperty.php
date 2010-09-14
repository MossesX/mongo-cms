<?php

namespace NS\Meta\Property;

use \NS\Core\Cls\Fluent\Options;

abstract class AbstractProperty extends Options
{
	protected $_property;
	protected $_key;

	/**
	 * Key getter
	 *
	 * @return string
	 */
	public function getKey()
	{
		return $this->_key ? $this->_key : $this->_property;
	}
}
