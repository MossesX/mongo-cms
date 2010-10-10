<?php

namespace NS\Modules\Core\Services;

use NS\Modules\Core\Models\BlockType as ModelBlockType,
	NS\Modules\Core\Models\BlockTypeCollection as ModelBlockTypeCollection,
	NS\Service\AbstractService;

class BlockType extends AbstractService
{
	protected $_module = 'core';

	/**
	 * Retrieves block types
	 * 
	 * @return ModelBlockCollection
	 */
	public function getBlockTypes()
	{
		$select = $this->_db
			->select()
			->from('core_block_type');

		return new ModelBlockTypeCollection($this->_db->fetchAll($select));
	}
}
