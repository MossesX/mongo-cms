<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class ModelCollectionManyStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * Group->setUsers(Users)
	 * 
	 * @return ModelCollectionManyStrategy
	 */
	public function set()
	{
		$rel = $this->getRelation();
		$collectionClassName = $rel->getModel() . 'Collection';
		$resCollection = $collectionClassName::create();

		$model = $this->getModel();
		$relatedCollection = $this->getRelatedModel();

		foreach ($relatedCollection as $relModel)
			if ($relModel->getProperty($rel->getForeignProperty()) == $model->getProperty($rel->getLocalProperty()))
				$resCollection->addModel($relModel);

		$model->setPropertyExact($rel->getProperty(), $resCollection);
		return $this;
	}
}
