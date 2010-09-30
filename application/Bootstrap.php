<?php

use Doctrine\Common\ClassLoader,
	Doctrine\Common\Annotations\AnnotationReader,
	Doctrine\ODM\MongoDB\Configuration,
	Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver,
	Doctrine\ODM\MongoDB\Mongo,
	Doctrine\ODM\MongoDB\DocumentManager;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initLoader()
	{
		if (!class_exists('Zend_Loader_Autoloader'))
			require_once 'Zend/Loader/Autoloader.php';
		$autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);

		// Modules autoload
		$autoloader->pushAutoloader(function($name){
			$sl = strrpos($name, '\\');
			require_once realpath(APPLICATION_PATH . substr(strtolower($name), 2, $sl - 2) . '/' . substr($name, $sl + 1) . '.php');
		}, 'NS\Modules');
	}

	protected function _initOptions()
	{
		Zend_Controller_Front::getInstance()
			->addModuleDirectory(realpath(APPLICATION_PATH . '/modules'));
	}

	protected function _initDb()
	{
		$db = $this->getOption('db');
		$dsn = new \NS\DbInfo\DSN($db['dsn']);
		$options = array(
			'host' => $dsn->getHost(),
			'username' => $dsn->getUserName(),
			'password' => $dsn->getPassword(),
			'dbname' => $dsn->getDbName(),
			'profiler' => false,
			'cacheMetadata' => false,
			'driver_options'=> array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8')
		);
		$db = Zend_Db::factory('PDO_MYSQL', $options);

		\NS\Service\AbstractService::setDefaultAdapter($db);
		
		return $db;
	}

	protected function _i1nitDoctrineODM()
	{
		require_once 'Doctrine/Common/ClassLoader.php';

		$classLoader = new ClassLoader('Doctrine\Common');
		$classLoader->register();

		$classLoader = new ClassLoader('Doctrine\ODM\MongoDB');
		$classLoader->register();

		//$classLoader = new ClassLoader('Symfony', __DIR__ . '/../../lib/vendor');
		//$classLoader->register();

		//$classLoader = new ClassLoader('Document\Core', APPLICATION_PATH . '/modules/default/models');
		//$classLoader->register();

		$classLoader = new ClassLoader(null, APPLICATION_PATH . '/modules/default/models');
		$classLoader->register();

		$config = new Configuration();

		$config->setProxyDir(APPLICATION_PATH . '/data/proxies');
		$config->setProxyNamespace('Proxies');
		$config->setDefaultDB('cms');

		/*
		$config->setLoggerCallable(function(array $log) {
			print_r($log);
		});
		$config->setMetadataCacheImpl(new ApcCache());
		*/

		$reader = new AnnotationReader();
		$reader->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
		$config->setMetadataDriverImpl(new AnnotationDriver($reader, APPLICATION_PATH . '/modules/default/models'));

		Zend_Registry::set('dm', DocumentManager::create(new Mongo(), $config));
	}
}

