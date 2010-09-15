<?php

namespace NS\Meta\Property;

use \NS\Meta\Exception;

class Type extends \NS\Core\Cls\Fluent
{
	protected $_type;
	protected $_params = array();

	/**
	 * Type setter
	 *
	 * @param string $strType
	 * @return Type
	 */
	public function setType($strType)
	{
		$arrType = explode('(', strtolower($strType));
		$this->_type = $arrType[0];
		$this->setParams(isset($arrType[1]) ? explode(', ', substr($arrType[1], 0, -1)) : array());
		return $this;
	}

	/**
	 * Filter value
	 *
	 * @param string $value
	 * @return mixed
	 */
	public function fromString($value)
	{
		$method = '_stringTo' . ucfirst($this->getType());

		if (!method_exists($this, $method))
			$method = '_fromString';

		return $this->$method($value);
	}

	public function toString($value)
	{
		$method = '_' . $this->getType() . 'ToString';

		if (!method_exists($this, $method))
			$method = '_toString';

		return $this->$method($value);
	}

	protected function _fromString($value)
	{
		return $value;
	}

	protected function _toString($value)
	{
		return (string)$value;
	}

	protected function _stringToInt($value)
	{
		return (int)$value;
	}

	protected function _stringToVarchar($value)
	{
		return isset($this->_params[0]) ? substr($value, 0, $this->_params[0]) : $value;
	}

	protected function _stringToBoolean($value)
	{
		return (bool)$value;
	}

	protected function _booleanToString($value)
	{
		return (string)(int)$value;
	}
}
