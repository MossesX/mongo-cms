<?php

namespace NS\Meta\Property;

abstract class Relation extends AbstractProperty
{
	const TYPE_ONE = 'one';
	const TYPE_MANY = 'many';

	protected $_type;
	protected $_model;
	protected $_localProperty;
	protected $_foreignProperty;

	/**
	 * Type setter
	 *
	 * @param string $type
	 * @return Relation
	 */
	public function setType($type)
	{
		$type = strtolower($type);
		$this->_type = $type == self::TYPE_ONE || $type == self::TYPE_MANY ? $type : self::TYPE_ONE;
		return $this;
	}
}
