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
	 * Modules configs
	 * @var Zend_Config
	 */
	protected static $_config;

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

	/**
	 * Sets default db adapter
	 * 
	 * @param mixed $db
	 * @return mixed
	 */
	public static function setDefaultAdapter($db)
	{
		return self::$_defaultAdapter = $db;
	}

	/**
	 * Loads modules configs
	 * 
	 * @param string $modulesDir
	 * @param bool $useCache
	 * @return \Zend_Config
	 */
	public static function loadConfig($modulesDir, $useCache = false)
	{
		$configFiles = array('defaults.ini', 'module.ini', 'routes.ini');

		self::$_config = new \Zend_Config(array(), true);
		foreach(new \DirectoryIterator($modulesDir) as $dir) {
			if (!$dir->isDot()) {
				$moduleName = $dir->getFilename();
				foreach ($configFiles as $file){
					$ini = realpath($dir->getRealPath() . '/configs/' . $file);
					if ($ini){
						$c = self::$_config->$moduleName;
						if (!$c){
							self::$_config->$moduleName = array();
							$c = self::$_config->$moduleName;
						}
						$c->merge(new \Zend_Config_Ini($ini));
					}
				}
			}
		}
		
		return self::$_config;
	}
}
