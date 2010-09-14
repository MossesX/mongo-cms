<?php

namespace NS\Meta;

use \NS\Core\Cls\Fluent\Options;

class Reference extends Options
{
	protected $_type;
	protected $_key;
	protected $_field;
	protected $_localField;
	protected $_foreignField;

	public function getKey()
	{
		return $this->_key;
	}
}
