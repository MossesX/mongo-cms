<?php

namespace NS\Meta;

use \NS\Core\Cls\Fluent\Options;

class Reference extends Options
{
	protected $_type;
	protected $_key;
	protected $_property;
	protected $_localproperty;
	protected $_foreignProperty;

	public function getKey()
	{
		return $this->_key;
	}
}
