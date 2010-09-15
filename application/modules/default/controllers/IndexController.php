<?php

//use Documents\Core\Language;

use \NS\Meta\Model\Model;

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		//$lang = new Core\Language($name);
		//$lang = new Language('en');

		//$dm = Zend_Registry::get('dm');
		//$dm->persist($lang);
		//$dm->flush();

		$u = new User();
		$u->fromArray(array(
			'id' => 'asdfasdf',
			'name' => 'UserName',
			'password' => md5('123'),
			'someOtherValue' => 'value12313123'
		));

		var_dump($u->toArray());

		die();
	}


}

