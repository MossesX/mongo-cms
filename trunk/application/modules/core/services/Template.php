<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Template as ModelTemplate,
	NS\Modules\Core\Models\TemplateCollection as ModelTemplateCollection,
	NS\Service\AbstractService;

class Template extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves template by id
	 *
	 * @param int $id
	 * @return ModelTemplate
	 */
	public function getTemplate($id)
	{
		$select = $this->_db
			->select()
			->from('core_template')
			->where('id = ?', $id)
			->limit(1);

		$arrSite = $this->_db->fetchRow($select);
		return $arrSite ? new ModelTemplate($arrSite) : null;
	}
}
