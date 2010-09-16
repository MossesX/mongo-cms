<?php

namespace NS\Meta\Model;

use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;
use \NS\Meta\Model\Model;

abstract class Collection extends AbstractModel implements SeekableIterator, Countable, ArrayAccess
{
	/**
	 * Models
	 * @var array
	 */
	protected $_models = array();

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public function fromArray(array $array)
	{
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
		return $this->key() >= 0 && $this->key() < $this->count();
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
