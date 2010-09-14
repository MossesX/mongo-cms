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
			include_once 'Zend/Loader/Autoloader.php';
		$autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);
	}

	protected function _initOptions()
	{
		Zend_Controller_Front::getInstance()
			->addModuleDirectory(realpath(APPLICATION_PATH . '/modules'));
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

