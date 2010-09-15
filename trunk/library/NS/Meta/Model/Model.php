<?php

namespace NS\Meta\Model;

use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

abstract class Model extends AbstractModel
{
	/**
	 * References
	 * @var array
	 */
	protected $_references = array();

	/**
	 * Relations
	 * @var array
	 */
	protected $_relations = array();

	/**
	 * Add reference
	 *
	 * @param Reference
	 * @return Model
	 */
	public function addReference(Reference $reference)
	{
		$this->_references[$reference->getKey()] = $reference;
		return $this;
	}

	/**
	 * Add relation
	 *
	 * @param Relation
	 * @return Model
	 */
	public function addRelation(Relation $relation)
	{
		$this->_relations[$relation->getKey()] = $relation;
		return $this;
	}

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public function fromArray(array $array)
	{
		// References
		foreach ($this->_references as $key => $reference)
			if (isset($array[$key]))
				$this->setProperty($reference->getProperty(), $reference->fromString($array[$key]));

		// Relations
		foreach ($this->_relations as $key => $relation){
			if ($relation->getType() == Relation::TYPE_ONE){
				if (isset($array[$key]) && is_array($array[$key]) && count($array[$key])){
					$relModel = $relation->getModel();
					$relModel = $relModel::create()
						->setProperty($relation->getForeignProperty(), $this->getProperty($relation->getLocalProperty()))
						->fromArray($array[$key]);
					$this->setProperty($relation->getProperty(), $relModel);
				}
			}
		}

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

		// References
		foreach ($this->_references as $key => $reference)
			$res[$key] = $reference->toString($this->getProperty($key));

		// Relations
		foreach ($this->_relations as $key => $relation){
			if ($relation->getType() == Relation::TYPE_ONE){
				$relModel = $this->getProperty($key);
				if ($relModel)
					$res[$key] = $relModel->toArray();
			}
		}

		return $res;
	}
}
