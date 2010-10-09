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
	 * @param Model|string $model
	 * @param Reference $reference
	 * @return Registry
	 */
	public function addReference($model, Reference $reference)
	{
		$className = is_string($model) ? $model : get_class($model);
		if (!isset($this->_references[$className]))
			$this->_references[$className] = array();
		
		$this->_references[$className][$reference->getKey()] = $reference;
		return $this;
	}

	/**
	 * Add references array
	 *
	 * @param Model|string $model
	 * @param array
	 * @return Registry
	 */
	public function addReferences($model, array $references)
	{
		foreach ($references as $ref)
			$this->addReference($model, $ref);
		return $this;
	}

	/**
	 * Retrieves references
	 *
	 * @param Model|string $model
	 * @return array
	 */
	public function getReferences($model)
	{
		$className = is_string($model) ? $model : get_class($model);
		return isset($this->_references[$className]) ? $this->_references[$className] : array();
	}

	/**
	 * Add relation
	 *
	 * @param Model|string $model
	 * @param Relation $relation
	 * @return Model
	 */
	public function addRelation($model, Relation $relation)
	{
		$className = is_string($model) ? $model : get_class($model);
		if (!isset($this->_relations[$className]))
			$this->_relations[$className] = array();

		$this->_relations[$className][$relation->getProperty()] = $relation;
		return $this;
	}

	/**
	 * Add relations array
	 *
	 * @param Model|string $model
	 * @param array
	 * @return Registry
	 */
	public function addRelations($model, array $relations)
	{
		foreach ($relations as $rel)
			$this->addRelation($model, $rel);
		return $this;
	}

	/**
	 * Retrieves relations
	 *
	 * @param Model|string $model
	 * @return array
	 */
	public function getRelations($model)
	{
		$className = is_string($model) ? $model : get_class($model);
		return isset($this->_relations[$className]) ? $this->_relations[$className] : array();
	}

	/**
	 * Retrieves relation
	 *
	 * @param Model|string $model
	 * @param string $property
	 * @return Relation
	 */
	public function getRelation($model, $property)
	{
		if (is_a($model, '\NS\Meta\Model\Collection'))
			$className = $model->getModel();
		else
			$className = is_string($model) ? $model : get_class($model);
		
		if ($className[0] == '\\')
			$className = substr($className, 1);
		
		return isset($this->_relations[$className]) && isset($this->_relations[$className][$property]) ?
			$this->_relations[$className][$property] : null;
	}

	/**
	 * Retrieves relation between two models
	 *
	 * @param Model|string $model1
	 * @param Model|string $model2
	 * @return Relation
	 */
	public function getRelationBetween($model1, $model2)
	{
		$model1 = is_string($model1) ? $model1 : get_class($model1);
		$model2 = is_string($model2) ? $model2 : get_class($model2);

		if (isset($this->_relations[$model1]))
			foreach ($this->_relations[$model1] as $rel)
				if ($rel->getModel() == $model2)
					return $rel;

		return null;
	}
}
