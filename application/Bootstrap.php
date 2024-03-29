<?php

class Bootstrap extends \Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Classes autoload initialization
	 *
	 */
	protected function _initLoader()
	{
		if (!class_exists('Zend_Loader_Autoloader'))
			require_once 'Zend/Loader/Autoloader.php';
		$autoloader = \Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);

		// Modules autoload
		$autoloader->pushAutoloader(function($name){
			$sl = strrpos($name, '\\');
			require_once realpath(APPLICATION_PATH . substr(strtolower($name), 2, $sl - 2) . '/' . substr($name, $sl + 1) . '.php');
		}, 'NS\Modules');
	}

	/**
	 * Options initialization
	 * 
	 */
	protected function _initOptions()
	{
		// Options
		$modulesDir = realpath(APPLICATION_PATH . '/modules');

		// Modules dir
		Zend_Controller_Front::getInstance()
			->addModuleDirectory($modulesDir);

		// Modules config files
		NS\Service\AbstractService::loadConfig($modulesDir);
	}

	/**
	 * Database initialization
	 *
	 * @return Zend_Db_Adapter_Abstract
	 */
	protected function _initDb()
	{
		$db = $this->getOption('db');
		$dsn = new \NS\DbInfo\DSN($db['dsn']);
		$options = array(
			'host' => $dsn->getHost(),
			'username' => $dsn->getUserName(),
			'password' => $dsn->getPassword(),
			'dbname' => $dsn->getDbName(),
			'profiler' => true,
			'cacheMetadata' => false,
			'driver_options'=> array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8')
		);
		$db = Zend_Db::factory('PDO_MYSQL', $options);

		\NS\Service\AbstractService::setDefaultAdapter($db);
		
		return $db;
	}

	/**
	 * Routes initialization
	 *
	 * @return Zend_Controller_Router
	 */
	protected function _initRoutes()
	{
		$this->bootstrapOptions();

		$router = new \Zend_Controller_Router_Rewrite();
		foreach (\NS\Service\AbstractService::getConfig() as $module => $config)
			if ($config->routes)
				foreach ($config->routes as $r => $routeConfig)
					$router->addRoute($module . '_' . $r, \Zend_Controller_Router_Route::getInstance($routeConfig));

		\Zend_Controller_Front::getInstance()->setRouter($router);

		return $router;
	}

	/**
	 * Init view
	 *
	 */
	protected function _initView()
	{
		Zend_Layout::startMvc();
	}
}
