<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Area as ModelArea,
	NS\Modules\Core\Models\AreaCollection as ModelAreaCollection,
	NS\Service\AbstractService;

class Area extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves areas
	 *
	 * @param int $templateID
	 * @return ModelAreaCollection
	 */
	public function getAreas($templateID)
	{
		$select = $this->_db
			->select()
			->from('core_area')
			->where('core_template_id = ?', $templateID);

		return new ModelAreaCollection($this->_db->fetchAll($select));
	}
}
