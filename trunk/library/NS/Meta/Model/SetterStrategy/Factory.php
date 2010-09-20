<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Property\Relation;
use \NS\Meta\Model\AbstractModel;
use \NS\Meta\Model\Model;
use \NS\Meta\Model\Collection;
use \NS\Meta\Model\SetterStrategy;
use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class Factory
{
	/**
	 * Strategy creation
	 *
	 * @param AbstractModel $model
	 * @param AbstractModel $relatedModel
	 * @param Relation $relation
	 * @return AbstractStrategy
	 */
	public static function create(AbstractModel $model, AbstractModel $relatedModel, Relation $relation)
	{
		$modelKey = is_subclass_of($model, '\NS\Meta\Model\Model') ? 'Model' : 'Collection';
		$relatedModelKey = is_subclass_of($relatedModel, '\NS\Meta\Model\Model') ? 'Model' : 'Collection';
		$relationKey = $relation->getType() == Relation::TYPE_ONE ? 'One' : 'Many';

		$className = '\NS\Meta\Model\SetterStrategy\\'.$modelKey.$relatedModelKey.$relationKey.'Strategy';
		$strategy = class_exists($className) ? $className : '\NS\Meta\Model\SetterStrategy\DefaultStrategy';

		return $strategy::create()
			->setModel($model)
			->setRelatedModel($relatedModel)
			->setRelation($relation);
	}
}
