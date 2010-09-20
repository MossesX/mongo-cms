<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class ModelCollectionOneStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * User->setGroup(Groups)
	 * 
	 * @return ModelCollectionOneStrategy
	 */
	public function set()
	{
		$rel = $this->getRelation();

		$model = $this->getModel();
		$relatedCollection = $this->getRelatedModel();

		foreach ($relatedCollection as $relModel){
			if ($relModel->getProperty($rel->getForeignProperty()) == $model->getProperty($rel->getLocalProperty())){
				$model->setPropertyExact($rel->getProperty(), $relModel);
				break;
			}
		}

		return $this;
	}
}
