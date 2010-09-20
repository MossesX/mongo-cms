<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class ModelModelOneStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * User->setGroup(Group)
	 * 
	 * @return ModelModelOneStrategy
	 */
	public function set()
	{
		$this->getModel()->setPropertyExact(
			$this->getRelation()->getProperty(),
			$this->getRelatedModel()
		);
		return $this;
	}
}
