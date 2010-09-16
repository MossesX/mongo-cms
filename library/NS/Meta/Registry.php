<?php

namespace NS\Meta;

use \NS\Core\Cls\Singleton;
use \NS\Meta\Model\Model;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

class Registry extends Singleton
{
	/**
	 * References
	 * @var array
	 */
	private $_references = array();

	/**
	 * Relations
	 * @var array
	 */
	private $_relations = array();

	/**
	 * Add reference
	 *
	 * @param Model $model
	 * @param Reference $reference
	 * @return Registry
	 */
	public function addReference(Model $model, Reference $reference)
	{
		$className = get_class($model);
		if (!isset($this->_references[$className]))
			$this->_references[$className] = array();
		
		$this->_references[$className][$reference->getKey()] = $reference;
		return $this;
	}

	/**
	 * Add references array
	 *
	 * @param Model $model
	 * @param array
	 * @return Registry
	 */
	public function addReferences(Model $model, array $references)
	{
		foreach ($references as $ref)
			$this->addReference($model, $ref);
		return $this;
	}

	/**
	 * Retrieves references
	 *
	 * @param Model $model
	 * @return array
	 */
	public function getReferences(Model $model)
	{
		$className = get_class($model);
		return isset($this->_references[$className]) ? $this->_references[$className] : array();
	}

	/**
	 * Add relation
	 *
	 * @param Model $model
	 * @param Relation $relation
	 * @return Model
	 */
	public function addRelation(Model $model, Relation $relation)
	{
		$className = get_class($model);
		if (!isset($this->_relations[$className]))
			$this->_relations[$className] = array();

		$this->_relations[$className][$relation->getKey()] = $relation;
		return $this;
	}

	/**
	 * Add relations array
	 *
	 * @param Model $model
	 * @param array
	 * @return Registry
	 */
	public function addRelations(Model $model, array $relations)
	{
		foreach ($relations as $rel)
			$this->addRelation($model, $rel);
		return $this;
	}

	/**
	 * Retrieves relations
	 *
	 * @param Model $model
	 * @return array
	 */
	public function getRelations(Model $model)
	{
		$className = get_class($model);
		return isset($this->_relations[$className]) ? $this->_relations[$className] : array();
	}
}
