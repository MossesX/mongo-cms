<?php

namespace NS\Meta\Model;

use \NS\Meta\Registry;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;
use \NS\Meta\Model\Model;

abstract class Collection extends AbstractModel implements \SeekableIterator, \Countable, \ArrayAccess
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

	/**
	 * Call
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 *
	 * @thows \NS\Core\Cls\Exception\PropertyNotFound
	 * @thows \NS\Core\Cls\Exception\MethodNotFound
	 */
	public function __call($name, $arguments)
	{
		$prefix = substr($name, 0, 3);
		$relCollection = $arguments[0];
		if ($prefix == 'set' && is_subclass_of($relCollection, '\NS\Meta\Model\Collection')) {
			$property = substr($name, 3);
			$property = strtolower($property[0]) . substr($property, 1);
			$rel = Registry::getInstance()->getRelation($this->_model, $property);
			if ($rel) {
				if ($rel->getType() == Relation::TYPE_MANY){
					$cls = get_class($relCollection);
					$col = $cls::create();
					foreach ($this as $model){
						throw new \NS\Meta\Exception('TODO HERE infinite loop :(');
						foreach ($relCollection as $relModel){
							if ($relModel && $model->getProperty($rel->getLocalProperty()) == $relModel->getProperty($rel->getForeignProperty())){
								//$col->addModel($relModel);
								break;
							}
						}
					}

					if (count($col))
						$model->setProperty($rel->getLocalProperty(), $col);
				}
			}
		}

		parent::__call($name, $arguments);
	}

    /**
	 * Rewind the Iterator to the first element.
	 * Similar to the reset() function for arrays in PHP.
	 * Required by interface Iterator.
	 *
	 * @return Collection Fluent interface.
	 */
	public function rewind()
	{
		reset($this->_models);
		return $this;
	}

	/**
	 * Return the current element.
	 * Similar to the current() function for arrays in PHP
	 * Required by interface Iterator.
	 *
	 * @return Model current element from the collection
	 */
	public function current()
	{
		return current($this->_models);
	}

	/**
	 * Return the identifying key of the current element.
	 * Similar to the key() function for arrays in PHP.
	 * Required by interface Iterator.
	 *
	 * @return int
	 */
	public function key()
	{
		return key($this->_models);
	}

	/**
	 * Move forward to next element.
	 * Similar to the next() function for arrays in PHP.
	 * Required by interface Iterator.
	 *
	 * @return void
	 */
	public function next()
	{
		next($this->_models);
	}

	/**
	 * Check if there is a current element after calls to rewind() or next().
	 * Used to check if we've iterated to the end of the collection.
	 * Required by interface Iterator.
	 *
	 * @return bool False if there's nothing more to iterate over
	 */
	public function valid()
	{
		$k = $this->key();
		return $k >= 0 && $k < $this->count();
	}

	/**
	 * Returns the number of elements in the collection.
	 *
	 * Implements Countable::count()
	 *
	 * @return int
	 */
	public function count()
	{
		return count($this->_models);
	}

	/**
	 * Take the Iterator to position $position
	 * Required by interface SeekableIterator.
	 *
	 * @param int $position the position to seek to
	 * @return Collection
	 */
	public function seek($position)
	{
		return $this;
	}

	/**
	 * Check if an offset exists
	 * Required by the ArrayAccess implementation
	 *
	 * @param string $offset
	 * @return boolean
	 */
	public function offsetExists($offset)
	{
		return isset($this->_models[(int)$offset]);
	}

	/**
	 * Get the row for the given offset
	 * Required by the ArrayAccess implementation
	 *
	 * @param string $offset
	 * @return Model
	 */
	public function offsetGet($offset)
	{
		return $this->_models[(int)$offset];
	}

	/**
	 * Required by the ArrayAccess implementation
	 *
	 * @param string $offset
	 * @param mixed $value
	 */
	public function offsetSet($offset, $value)
	{
		$this->_models[(int)$offset] = $value;
	}

	/**
	 * Required by the ArrayAccess implementation
	 *
	 * @param string $offset
	 */
	public function offsetUnset($offset)
	{
		unset($this->_models[(int)$offset]);
	}
}
