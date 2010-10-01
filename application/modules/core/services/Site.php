<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Site as ModelSite,
	NS\Modules\Core\Models\SiteCollection as ModelSiteCollection,
	NS\Service\AbstractService;

class Site extends AbstractService
{
	/**
	 * Retrieves sites list
	 *
	 * @return ModelSiteCollection
	 */
	public function getSites()
	{
		$arrSites = $this->_db->fetchAll($this->_db
			->select()
			->from('core_site')
			->order('title')
		);
		return new ModelSiteCollection($arrSites);
	}

	/**
	 * Retrieves default site
	 *
	 * @return ModelSite
	 */
	public function getDefaultSite()
	{
		return $this->getSite();
	}

	/**
	 * Retrieves site by name or id
	 *
	 * @param int|string|null $id
	 * @return ModelSite
	 */
	public function getSite($id = null)
	{
		$select = $this->_db
			->select()
			->from('core_site')
			->limit(1);

		if (is_null($id))
			$select->order('title');
		else
			$select->where((is_int($id) ? 'id' : 'name').' = ?', $id);

		$arrSite = $this->_db->fetchRow($select);
		return $arrSite ? new ModelSite($arrSite) : null;
	}
}
