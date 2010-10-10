<?php

use NS\Modules\Stext\Services;

class Stext_IndexController extends Zend_Controller_Action
{
	/**
	 * Text block output
	 * 
	 */
	public function indexAction()
	{
		$block = $this->_getParam('__block');
		if ($block){
			$blockService = new Services\Block();
			$textBlock = $blockService->getBlock($block->getId());
			if ($textBlock){
				$this->view->text = $textBlock->getText();
				$this->view->textBlock = $textBlock;
			}
		}
	}
}

