<?php

namespace NS\Modules\Stext\Services;

use NS\Modules\Stext\Models\Block as ModelBlock,
	NS\Modules\Stext\Models\BlockCollection as ModelBlockCollection,
	NS\Service\AbstractService;

class Block extends AbstractService
{
	protected $_module = 'stext';

	/**
	 * Retrieves text block
	 *
	 * @param int $blockID
	 * @return ModelBlock
	 */
	public function getBlock($blockID)
	{
		$select = $this->_db
			->select()
			->from('stext_block')
			->where('core_block_id = ?', $blockID)
			->limit(1);

		$arrSite = $this->_db->fetchRow($select);
		return $arrSite ? new ModelBlock($arrSite) : null;
	}

	/**
	 * Retrieves text blocks for the same pages with $blockID
	 *
	 * @param int $blockID
	 * @return ModelBlockCollection
	 */
	public function getBlocks($blockID)
	{
		return array();

		$select = $this->_db
			->select()
			->from('stext_block AS b')
			->where('core_block_id = ', $blockID)
			->joinInner('core_block_scheme AS s', 's.block');
	}
}
