<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Module as ModelModule,
	NS\Modules\Core\Models\ModuleCollection as ModelModuleCollection,
	NS\Service\AbstractService;

class Module extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves modules
	 * 
	 * @return ModelModuleCollection
	 */
	public function getModules()
	{
		$select = $this->_db
			->select()
			->from('core_module');

		return new ModelModuleCollection($this->_db->fetchAll($select));
	}
}
