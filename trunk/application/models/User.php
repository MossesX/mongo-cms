<?php

use \NS\Meta\Model\Model;
use \NS\Meta\Property\Reference;

class User extends Model
{
	protected $_id;
	protected $_name;
	protected $_password;


	public function __construct()
	{
		$this
			->addReference(Reference::create(array(
				'key' => 'id',
				'type' => 'int'
			)))
			->addReference(Reference::create(array(
				'key' => 'name',
				'type' => 'varchar(2)'
			)))
			->addReference(Reference::create(array(
				'key' => 'password',
				'type' => 'varchar(50)'
			)));
	}
}
