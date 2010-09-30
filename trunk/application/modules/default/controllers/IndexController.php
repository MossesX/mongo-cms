<?php

//use Documents\Core\Language;

use NS\Meta\Model\Model;

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		//$service = new NS\DbInfo\Service('mysql://root:@localhost/cms4');
		//var_dump($service->getTables('cms4'));

		$s = new NS\Modules\Core\Services\Site();
		var_dump($s->getSites());
		die();

		/*$g = new Group();
		$u = new UserCollection();
		$r = new \NS\Meta\Property\Relation();
		$s = \NS\Meta\Model\SetterStrategy\Factory::create($g, $u, $r);

		$s->set();

		die();*/

		$users = new UserCollection(array(
			array(
				'id' => 1,
				'name' => 'Admin#1',
				'group_id' => 1
			),
			array(
				'id' => 2,
				'name' => 'Admin#2',
				'group_id' => 1
			),
			array(
				'id' => 3,
				'name' => 'Admin#3',
				'group_id' => 1
			),
			array(
				'id' => 4,
				'name' => 'User#4',
				'group_id' => 3
			),
			array(
				'id' => 5,
				'name' => 'User#5',
				'group_id' => 3
			),
			array(
				'id' => 6,
				'name' => 'Guest#6',
				'group_id' => 2
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

		$group = new Group(array(
			'id' => 1,
			'name' => 'Admins'
		));

		$user = new User(array(
			'id' => 4,
			'name' => 'SingleUser',
			'group_id' => 1
		));


		?><h3><pre>$group->setUsers($users)</pre></h3><pre><?
			$group->setUsers($users);
			var_dump($group);
		?></pre><?

		?><h3><pre>$groups->setUsers($users)</pre></h3><pre><?
			$groups->setUsers($users);
			var_dump($groups);
		?></pre><?

		?><h3><pre>$user->setGroup($group)</pre></h3><pre><?
			$user->setGroup($group);
			var_dump($user);
		?></pre><?

		?><h3><pre>$user->setGroup($groups)</pre></h3><pre><?
			$user->setGroup($groups);
			var_dump($user);
		?></pre><?

		?><h3><pre>$users->setGroup($group)</pre></h3><pre><?
			$users->setGroup($group);
			var_dump($users);
		?></pre><?

		?><h3><pre>$users->setGroup($groups)</pre></h3><pre><?
			$users->setGroup($groups);
			var_dump($users);
		?></pre><?

		die();
	}


}

