<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class CollectionCollectionManyStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * Groups->setUsers(Users)
	 * 
	 * @return CollectionCollectionManyStrategy
	 */
	public function set()
	{
		$collection = $this->getModel();
		foreach ($collection as $model)
			$model->setProperty($this->getRelation()->getProperty(), $this->getRelatedModel());
		
		return $this;
	}
}
