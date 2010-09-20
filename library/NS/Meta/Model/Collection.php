<?php

namespace NS\Meta\Model;

use \NS\Meta\Registry;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;
use \NS\Meta\Model\Model;

abstract class Collection extends AbstractModel implements \IteratorAggregate
{
	/**
	 * Model
	 * @var string
	 */
	protected $_model;

	/**
	 * Models
	 * @var array
	 */
	public $_models = array();

	/**
	 * Constructor
	 *
	 * @param array $models
	 */
	public function __construct(array $models = null)
	{
		// Trying to build collection from array
		if (!is_null($models))
			$this->fromArray($models);
	}

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Collection
	 */
	public function fromArray(array $array)
	{
		if (!class_exists($this->_model))
			throw new ClassNotFound($this->_model);

		$className = $this->_model;
		foreach ($array as $arrModel){
			if (is_array($arrModel) && count($arrModel))
				$this->addModel($className::create()->fromArray($arrModel));
			else if (is_a($arrModel, $this->_model))
				$this->addModel($model);
		}
		return $this;
	}

	/**
	 * Add model
	 *
	 * @param Model $model
	 * @return Collection
	 */
	public function addModel(Model $model)
	{
		$this->_models[] = $model;
		return $this;
	}

	/**
	 * Converting model to array
	 *
	 * @return array
	 */
	public function toArray()
	{
		$res = array();

		return $res;
	}

    // Required definition of interface IteratorAggregate
	public function getIterator()
	{
		return new \ArrayIterator($this->_models);
	}
}
