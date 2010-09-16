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
		$users = new UserCollection(array(
			array(
				'id' => 1,
				'name' => 'Admin#1',
				'groupID' => 1
			),
			array(
				'id' => 2,
				'name' => 'Admin#2',
				'groupID' => 1
			),
			array(
				'id' => 3,
				'name' => 'Admin#3',
				'groupID' => 1
			),
			array(
				'id' => 4,
				'name' => 'User#4',
				'groupID' => 3
			),
			array(
				'id' => 5,
				'name' => 'User#5',
				'groupID' => 3
			),
			array(
				'id' => 6,
				'name' => 'Guest#6',
				'groupID' => 2
			)
		));

		$groups = new GroupCollection(array(
			array(
				'id' => 1,
				'name' => 'Admins'
			),
			array(
				'id' => 2,
				'name' => 'Guests'
			),
			array(
				'id' => 3,
				'name' => 'Users'
			)
		));

		$groups->setUsers($users);

		?><pre><?
		var_dump($groups);
		?></pre><?

		die();
	}


}

