<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class CollectionModelOneStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * Users->setGroup(Group)
	 * 
	 * @return CollectionModelOneStrategy
	 */
	public function set()
	{
		$rel = $this->getRelation();
		$relatedModel = $this->getRelatedModel();
		
		foreach ($this->getModel() as $model)
			$model->setProperty($rel->getProperty(), $relatedModel);

		return $this;
	}
}
