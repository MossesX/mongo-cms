<?php

use \NS\Meta\Model\Model;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

class Group extends Model
{
	protected $_id;
	protected $_name;
	protected $_userID;

	protected $_users;

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

			// Relations
			->addRelation(Relation::create(array(
				'key' => 'users',
				'type' => Relation::TYPE_MANY,
				'model' => 'User',
				'localProperty' => 'userID',
				'foreignProperty' => 'id',
			)));
	}
}
