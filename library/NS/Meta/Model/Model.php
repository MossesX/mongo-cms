<?php

namespace NS\Meta\Model;

use NS\Core\Cls\Exception\ClassNotFound,
	NS\Meta\Registry,
	NS\Meta\Property\Reference,
	NS\Meta\Property\Relation;

abstract class Model extends AbstractModel
{
	/**
	 * Constructor
	 *
	 * @param array $properties
	 */
	public function __construct(array $properties = null)
	{
		$this->init();

		if (!is_null($properties))
			$this->fromArray($properties);
	}

	/**
	 * Initialization
	 *
	 */
	public function init()
	{
	}

	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public function fromArray(array $array)
	{
		// Meta registry
		$registry = Registry::getInstance();

		// References
		foreach ($registry->getReferences($this) as $key => $ref)
			if (isset($array[$key]))
				$this->setProperty($ref->getProperty(), $ref->fromString($array[$key]));

		// Relations
		foreach ($registry->getRelations($this) as $key => $rel) {
			if ($rel->getType() == Relation::TYPE_ONE) {
				if (isset($array[$key]) && is_array($array[$key]) && count($array[$key])) {

					// Relation model
					$relModel = $rel->getModel();
					$relModel = $relModel::create()->fromArray($array[$key]);

					// Setting foreign key property by default
					$lp = $rel->getLocalProperty();
					if (is_null($this->getProperty($lp)))
						$this->setProperty($lp, $relModel->getProperty($rel->getForeignProperty()));

					// Setting base model property
					$this->setProperty($rel->getProperty(), $relModel);
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

		// Meta registry
		$registry = Registry::getInstance();

		// References
		foreach ($registry->getReferences($this) as $key => $ref)
			$res[$key] = $ref->toString($this->getProperty($key));

		// Relations
		foreach ($registry->getRelations($this) as $key => $rel){
			if ($rel->getType() == Relation::TYPE_ONE){
				$relModel = $this->getProperty($key);
				if ($relModel)
					$res[$key] = $relModel->toArray();
			}
		}
		return $res;
	}

	/**
	 * Add references
	 *
	 * @param array $references
	 * @return Model
	 */
	protected function _addReferences(array $references)
	{
		$registry = Registry::getInstance();
		foreach ($references as $reference){
			if (is_array($reference))
				$reference = new Reference($reference);
			$registry->addReference($this, $reference);
		}
		return $this;
	}

	/**
	 * Add relations
	 *
	 * @param array $relations
	 * @return Model
	 */
	protected function _addRelations(array $relations)
	{
		$registry = Registry::getInstance();
		foreach ($relations as $relation){
			if (is_array($relation))
				$relation = new Relation($relation);
			$registry->addRelation($this, $relation);
		}
		return $this;
	}
}
