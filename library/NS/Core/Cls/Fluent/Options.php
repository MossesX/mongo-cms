<?php

namespace NS\Core\Cls\Fluent;

use \NS\Core\Cls\Fluent;

abstract class Options extends Fluent
{
	/**
	 * Options
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Creation
	 *
	 * @param array $options
	 * @return Options
	 */
	public static function create(array $options = array())
	{
		return new static($options);
	}

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array())
	{
		$this->_options = array_merge($this->_options, $options);
		foreach ($this->_options as $key => &$value)
			if (property_exists($this, '_'.$key))
				call_user_func(array($this, 'set' . ucfirst($key)), $value);
	}
}
