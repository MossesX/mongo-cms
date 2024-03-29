<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Registry,
	NS\Meta\Property\Reference,
	NS\Meta\Property\Relation;

class Site extends Model
{
	protected $_id;
	protected $_templateID;
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
			'key' => 'core_template_id',
			'property' => 'templateID',
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
			'property' => 'pages',
			'type' => Relation::TYPE_MANY,
			'model' => '\NS\Modules\Core\Model\Page',
			'localProperty' => 'id',
			'foreignProperty' => 'siteID'
		),
		array(
			'property' => 'template',
			'type' => Relation::TYPE_ONE,
			'model' => '\NS\Modules\Core\Model\Template',
			'localProperty' => 'templateID',
			'foreignProperty' => 'id'
		)
	);
}
