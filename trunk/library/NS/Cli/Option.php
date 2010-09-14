<?php

namespace NS\Cli;

use \NS\Core\Cls\Fluent;

class Option extends Fluent
{
	protected $_required = false;
	protected $_name;
	protected $_man;

	public function setRequired($required)
	{
		$this->_required = (bool)$required;
		return $this;
	}

	public function isRequired()
	{
		return $this->getRequired();
	}

	public function __toString()
	{
		return '-' . $this->getName() . "\t" . $this->getMan();
	}
}
