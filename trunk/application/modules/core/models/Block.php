<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class Block extends Model
{
	protected $_id;
	protected $_blockTypeID;
	protected $_areaID;
	protected $_title;

	protected $_moduleID;

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
			'key' => 'core_block_type_id',
			'property' => 'blockTypeID',
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
		),

		array(
			'key' => 'core_module_id',
			'property' => 'moduleID',
			'type' => 'int'
		)
	);

	/**
	 * Relations
	 * @var array
	 */
	protected $_relations = array(
		array(
			'property' => 'blockType',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\BlockType',
			'localProperty' => 'blockTypeID',
			'foreignProperty' => 'id'
		),
		array(
			'property' => 'area',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Area',
			'localProperty' => 'areaID',
			'foreignProperty' => 'id'
		),
		array(
			'property' => 'module',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Module',
			'localProperty' => 'moduleID',
			'foreignProperty' => 'id'
		)
	);
}
