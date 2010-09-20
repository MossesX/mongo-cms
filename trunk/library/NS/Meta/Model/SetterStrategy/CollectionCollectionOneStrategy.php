<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class CollectionCollectionOneStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * Users->setGroup(Groups)
	 * 
	 * @return CollectionCollectionOneStrategy
	 */
	public function set()
	{
		$collection = $this->getModel();
		foreach ($collection as $model)
			$model->setProperty($this->getRelation()->getProperty(), $this->getRelatedModel());
		
		return $this;
	}
}
