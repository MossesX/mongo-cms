<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class Template extends Model
{
	protected $_id;
	protected $_siteID;
	protected $_title;
	protected $_layout;

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
			'key' => 'core_site_id',
			'property' => 'siteID',
			'type' => 'int'
		),
		array(
			'key' => 'title',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'layout',
			'type' => 'varchar(255)'
		)
	);

	/**
	 * Relations
	 * @var array
	 */
	protected $_relations = array(
		array(
			'property' => 'site',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Site',
			'localProperty' => 'siteID',
			'foreignProperty' => 'id'
		),
		array(
			'property' => 'areas',
			'type' => Relation::TYPE_MANY,
			'model' => '\NS\Modules\Core\Model\Area',
			'localProperty' => 'id',
			'foreignProperty' => 'templateID'
		)
	);
}
