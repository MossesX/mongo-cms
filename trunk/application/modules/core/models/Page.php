<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Registry,
	NS\Meta\Property\Reference,
	NS\Meta\Property\Relation;

class Page extends Model
{
	protected $_id;
	protected $_pageID;
	protected $_templateID;
	protected $_siteID;
	protected $_name;
	protected $_title;

	/**
	 * Initialization
	 *
	 */
	public function init()
	{
		$this->_addReferences(array(
			array(
				'key' => 'id',
				'type' => 'int'
			),
			array(
				'key' => 'core_page_id',
				'property' => 'pageID',
				'type' => 'int'
			),
			array(
				'key' => 'core_template_id',
				'property' => 'templateID',
				'type' => 'int'
			),
			array(
				'key' => 'core_site_id',
				'property' => 'siteID',
				'type' => 'int'
			),
			array(
				'key' => 'name',
				'type' => 'varchar(255)'
			),
			array(
				'key' => 'title',
				'type' => 'varchar(255)'
			)
		));

		$this->_addRelations(array(
			array(
				'property' => 'template',
				'type' => Relation::TYPE_ONE,
				'model' => '\NS\Modules\Core\Model\Template',
				'localProperty' => 'templateID',
				'foreignProperty' => 'id'
			),
			array(
				'property' => 'site',
				'type' => Relation::TYPE_ONE,
				'model' => '\NS\Modules\Core\Model\Site',
				'localProperty' => 'siteID',
				'foreighProperty' => 'id'
			)
		));
	}
}
