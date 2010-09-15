<?php

use \NS\Meta\Model\Model;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

class User extends Model
{
	protected $_id;
	protected $_name;
	protected $_password;
	protected $_isAdmin = false;

	protected $_group;


	public function __construct()
	{
		$this

			// References
			->addReference(Reference::create(array(
				'key' => 'id',
				'type' => 'int'
			)))
			->addReference(Reference::create(array(
				'key' => 'name',
				'type' => 'varchar(50)'
			)))
			->addReference(Reference::create(array(
				'key' => 'password',
				'type' => 'varchar(50)'
			)))
			->addReference(Reference::create(array(
				'key' => 'isAdmin',
				'type' => 'boolean'
			)))

			// Relations
			->addRelation(Relation::create(array(
				'key' => 'group',
				'type' => Relation::TYPE_ONE,
				'model' => 'Group',
				'localProperty' => 'id',
				'foreignProperty' => 'userID'
			)));
	}
}