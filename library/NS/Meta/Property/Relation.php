<?php

namespace NS\Meta\Property;

use \NS\Meta\Models\AbstractModel;
use \NS\Meta\Models\Model;
use \NS\Meta\Models\Collection;

class Relation extends AbstractProperty
{
	const TYPE_ONE = 'one';
	const TYPE_MANY = 'many';

	protected $_type;
	protected $_model;
	protected $_localProperty;
	protected $_foreignProperty;

	/**
	 * Type setter
	 *
	 * @param string $type
	 * @return Relation
	 */
	public function setType($type)
	{
		$type = strtolower($type);
		$this->_type = $type == self::TYPE_ONE || $type == self::TYPE_MANY ? $type : self::TYPE_ONE;
		return $this;
	}

	public function fill(AbstractModel $model, AbstractModel $related)
	{
		$part1 = \is_subclass_of($model, 'Model') ? 'Model' : 'Collection';
		$part2 = \is_subclass_of($related, 'Model') ? 'Model' : 'Collection';

		$method = '_fill'.$part1.'By'.$part2;
		if (\method_exists($this, $method))
			\call_user_func(array($this, $method), $model, $related);
		
		return $this;
	}

	protected function _fillModelByModel(Model $model, Model $related)
	{
		$model->setPropertyExact($this->getLocalProperty(), $related);
	}
}
