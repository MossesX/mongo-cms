<?php

namespace NS\Meta\Property;

use \NS\Meta\Models\AbstractModel;
use \NS\Meta\Models\Model;
use \NS\Meta\Models\Collection;

class Relation extends AbstractProperty
{
	const TYPE_ONE = 'one';
	const TYPE_MANY = 'many';

	/**
	 * Relation type
	 * @var string
	 */
	protected $_type;

	/**
	 * Related model class name
	 * @var string
	 */
	protected $_model;

	/**
	 * Local property
	 * @var string
	 */
	protected $_localProperty;

	/**
	 * Foreign property
	 * @var string
	 */
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
