<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Registry,
	NS\Meta\Property\Reference,
	NS\Meta\Property\Relation;

class Site extends Model
{
	protected $_id;
	protected $_title;

	/**
	 * Initialization
	 *
	 */
	public function init()
	{
		Registry::getInstance()
			->addReferences('NS\Modules\Core\Models\Site', array(
				Reference::create(array(
					'key' => 'id',
					'type' => 'int'
				)),
				Reference::create(array(
					'key' => 'title',
					'type' => 'varchar(255)'
				))
			))
			->addRelations('NS\Modules\Core\Models\Site', array(
				Relation::create(array(
					'property' => 'pages',
					'type' => Relation::TYPE_MANY,
					'model' => 'NS\Modules\Core\Model\Page',
					'localProperty' => 'id',
					'foreignProperty' => 'siteID'
				))
			));
	}
}
