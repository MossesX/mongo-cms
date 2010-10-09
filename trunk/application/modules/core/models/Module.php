<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class Module extends Model
{
	protected $_id;
	protected $_title;
	protected $_name;

	/**
	 * References
	 * @var array
	 */
	protected $_references = array(
		array(
			'key' => 'id',
			'type' => 'int'
		),
		array(
			'key' => 'title',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'name',
			'type' => 'varchar(255)'
		)
	);

	/**
	 * Relations
	 * @var array
	 */
	protected $_relations = array(
		array(
			'property' => 'block',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Block',
			'localProperty' => 'id',
			'foreignProperty' => 'moduleID'
		)
	);
}
