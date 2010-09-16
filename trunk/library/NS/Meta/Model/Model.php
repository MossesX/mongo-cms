<?php

namespace NS\Meta\Model;

use \NS\Meta\Registry;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

abstract class Model extends AbstractModel
{
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
					$relModel = $relModel::create()
						// Setting foreign key property by default
						->setProperty($rel->getForeignProperty(), $this->getProperty($rel->getLocalProperty()))
						// Setting other properties from array
						->fromArray($array[$key]);

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
}
