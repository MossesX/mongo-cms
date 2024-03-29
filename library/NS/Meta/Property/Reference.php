<?php

namespace NS\Meta\Property;

class Reference extends AbstractProperty
{
	public function setType($strType)
	{
		$this->_type = Type::create()->setType($strType);
	}
	
	public function fromString($value)
	{
		return $this->getType()->fromString($value);
	}

	public function toString($value)
	{
		return $this->getType()->toString($value);
	}
}
