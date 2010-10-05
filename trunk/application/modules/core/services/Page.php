<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Page as ModelPage,
	NS\Modules\Core\Models\PageCollection as ModelPageCollection,
	NS\Service\AbstractService;

class Page extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves page by id
	 *
	 * @param int|string $id
	 * @apram int $siteID
	 * @return ModelPage
	 */
	public function getPage($id, $siteID = null)
	{
		if (!$id)
			return null;

		$select = $this->_db
			->select()
			->from('core_page')
			->where((\is_numeric($id) ? 'id' : 'name').' = ?', $id)
			->limit(1);

		if (!\is_null($siteID))
			$select->where('core_site_id = ?', $siteID);

		$arrPage = $this->_db->fetchRow($select);
		return $arrPage ? new ModelPage($arrPage) : null;
	}

	/**
	 * Retrieves page 404
	 *
	 * @return ModelPage
	 */
	public function getPage404()
	{
		return $this->getPage($this->_getConfig()->errors->error404);
	}
}
