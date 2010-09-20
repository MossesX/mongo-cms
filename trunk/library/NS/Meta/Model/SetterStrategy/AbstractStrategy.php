<?php

namespace NS\Meta\Model\SetterStrategy;

abstract class AbstractStrategy extends \NS\Core\Cls\Fluent
{
	/**
	 * Model
	 * @var \NS\Meta\Model\AbstractModel
	 */
	protected $_model;

	/**
	 * Related model
	 * @var \NS\Meta\Model\AbstractModel
	 */
	protected $_relatedModel;

	/**
	 * Relation
	 * @var \NS\Meta\Property\Relation
	 */
	protected $_relation;

	/**
	 * Main setter
	 *
	 * @return AbstractStrategy
	 */
	public abstract function set();
}
