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
	 * @return SiteCollection
	 */
	public function getSites()
	{
		$arrSites = $this->_db->fetchAll($this->_db
			->select()
			->from(array('s' => 'core_site'))
			->order('title')
		);
		return new ModelSiteCollection($arrSites);
	}
}
