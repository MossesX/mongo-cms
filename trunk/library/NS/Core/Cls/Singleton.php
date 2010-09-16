<?php

namespace NS\Core\Cls;

abstract class Singleton
{
	/**
	 * Instance
	 * @var Singleton
	 */
	private static $_instance;

	/**
	 * Protected constructor
	 * 
	 */
	protected function __construct()
	{
	}

	/**
	 * Retrieving instance
	 * 
	 * @return Singleton
	 */
	public static function getInstance()
	{
		if (is_null(self::$_instance))
			self::$_instance = new static();
		return self::$_instance;
	}
}
