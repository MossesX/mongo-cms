<?php

use \NS\Meta\Registry;
use \NS\Meta\Model\Model;
use \NS\Meta\Property\Reference;
use \NS\Meta\Property\Relation;

class MetaRegistry extends Registry
{
	/**
	 * Init flag
	 * @var bool
	 */
	private static $_initialized = false;

	/**
	 * Initialization
	 *
	 */
	public static function init()
	{
		if (self::$_initialized) return;
		self::$_initialized= true;

		self::getInstance()
		// User
			// References
			->addReferences('User', array(
				Reference::create(array(
					'key' => 'id',
					'type' => 'int'
				)),
				Reference::create(array(
					'key' => 'name',
					'type' => 'varchar(50)'
				)),
				Reference::create(array(
					'key' => 'password',
					'type' => 'varchar(50)'
				)),
				Reference::create(array(
					'key' => 'group_id',
					'property' => 'groupID',
					'type' => 'int'
				)),
				Reference::create(array(
					'key' => 'isAdmin',
					'type' => 'boolean'
				))
			))
			// Relations
			->addRelations('User', array(
				Relation::create(array(
					'property' => 'group',
					'type' => Relation::TYPE_ONE,
					'model' => 'Group',
					'localProperty' => 'groupID',
					'foreignProperty' => 'id'
				))
			))

		// Group
			// References
			->addReferences('Group', array(
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
			->addRelations('Group', array(
				Relation::create(array(
					'property' => 'users',
					'type' => Relation::TYPE_MANY,
					'model' => 'User',
					'localProperty' => 'id',
					'foreignProperty' => 'groupID',
				))
			));
	}
}
