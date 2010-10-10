<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\Block as ModelBlock,
	NS\Modules\Core\Models\BlockCollection as ModelBlockCollection,
	NS\Service\AbstractService;

class Block extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves page or site blocks
	 *
	 * @param int $pageID
	 * @param int $siteID
	 * 
	 * @return ModelBlockCollection
	 */
	public function getPageBlocks($pageID, $siteID = null)
	{
		$select = $this->_db
			->select()
			->from('core_block AS b', array('b.*', 's.core_area_id'))
			->joinInner('core_block_scheme AS s', 's.core_block_id = b.id', array())
			->where('core_page_id = ?', $pageID);

		if (!\is_null($siteID))
			$select->orWhere('ISNULL(core_page_id) AND core_site_id = ?', $siteID);

		return new ModelBlockCollection($this->_db->fetchAll($select));
	}
}
