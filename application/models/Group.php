<?php

use \NS\Meta\Registry;
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
		Registry::getInstance()
			// References
			->addReferences($this, array(
				Reference::create(array(
					'key' => 'id',
					'type' => 'int'
				)),
				Reference::create(array(
					'key' => 'name',
					'type' => 'varchar(50)'
				))
			))
			// Relations
			->addRelations($this, array(
				Relation::create(array(
					'key' => 'users',
					'type' => Relation::TYPE_MANY,
					'model' => 'User',
					'localProperty' => 'userID',
					'foreignProperty' => 'id',
				))
			));
	}
}
