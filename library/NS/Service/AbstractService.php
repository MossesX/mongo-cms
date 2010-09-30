<?php

namespace NS\Service;

abstract class AbstractService
{
	/**
	 * Zend_Db adapter
	 * @var Zend_Db_Adapter_Abstract
	 */
	protected static $_defaultAdapter;

	/**
	 * Current Zend_Db adapter
	 * @var Zend_Db_Adapter_Abstract
	 */
	protected $_db;

	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		$this->_db = self::$_defaultAdapter;
	}

	public static function setDefaultAdapter($db)
	{
		self::$_defaultAdapter = $db;
	}
}
