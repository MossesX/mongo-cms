<?php

namespace NS\Modules\Stext\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class Block extends Model
{
	protected $_id;
	protected $_blockID;
	protected $_text;

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
			'key' => 'core_block_id',
			'property' => 'blockID',
			'type' => 'int'
		),
		array(
			'key' => 'title',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'text',
			'type' => 'varchar'
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
			'localProperty' => 'blockID',
			'foreignProperty' => 'id'
		)
	);
}
