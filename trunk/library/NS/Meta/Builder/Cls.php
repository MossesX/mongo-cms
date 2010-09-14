<?php

namespace NS\Meta\Builder;

use \NS\Core\Cls\Fluent;

class Cls extends Fluent
{
	protected $_header;
	protected $_name;

	public function write()
	{
		return $this->_header."\n".
			'class '.$this->getName()."\n".
			"{\n".
			"}\n";
	}
}
