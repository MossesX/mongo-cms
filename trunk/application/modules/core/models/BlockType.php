<?php

namespace NS\Modules\Core\Models;

use NS\Meta\Model\Model,
	NS\Meta\Property\Relation;

class BlockType extends Model
{
	protected $_id;
	protected $_moduleID;
	protected $_title;
	protected $_module;
	protected $_controller;
	protected $_action;

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
			'key' => 'title',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'module',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'controller',
			'type' => 'varchar(255)'
		),
		array(
			'key' => 'action',
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
		)
	);

	/**
	 * Controller getter
	 *
	 * @return string
	 */
	public function getController()
	{
		return $this->_controller ? $this->_controller : 'index';
	}

	/**
	 * Action getter
	 *
	 * @return string
	 */
	public function getAction()
	{
		return $this->_action ? $this->_action : 'index';
	}
		
}
