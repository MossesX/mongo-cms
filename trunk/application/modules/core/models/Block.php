<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class Block extends Model
{
	protected $_id;
	protected $_moduleID;
	protected $_areaID;
	protected $_title;

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
			'key' => 'core_module_id',
			'property' => 'moduleID',
			'type' => 'int'
		),
		array(
			'key' => 'core_area_id',
			'property' => 'areaID',
			'type' => 'int'
		),
		array(
			'key' => 'title',
			'type' => 'varchar(255)'
		)
	);

	/**
	 * Relations
	 * @var array
	 */
	protected $_relations = array(
		array(
			'property' => 'module',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Module',
			'localProperty' => 'moduleID',
			'foreignProperty' => 'id'
		),
		array(
			'property' => 'area',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Area',
			'localProperty' => 'areaID',
			'foreignProperty' => 'id'
		)
	);
}
