<?php

use NS\Modules\Core\Services,
	NS\Core;

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
	}

	public function indexAction()
	{
		// Retrieving site ID
		$arr = array(
			$this->_getParam('__siteID'),
			$this->_getParam('__siteName'),
			getenv('SITE_ID'),
			getenv('SITE_NAME')
		);
		sort($arr);
		$siteID = array_pop($arr);

		// Services
		$siteService = new Services\Site();
		$pageService = new Services\Page();

		// Retrieving site
		$site = $siteService->getSite($siteID);
		if ($site){
			$pageID = $this->_getParam('__pageID');
			$page = $pageService->getPage($pageID, $site->getId()) or $page = $pageService->getPage404();
		}
		else {
			// 404 of a default site if site doesn't exist
			$site = $siteService->getDefaultSite();
			if (!$site)
				throw new Core\Exception("Site detection error");
			$page = $pageService->getPage404();
		}
	
		if (!$page)
			throw new Core\Exception("Page #$pageID doesn't exist");

		// Setting site
		$page->setSite($site);

		// Retrieving page blocks
		$blockService = new Services\Block();
		$blocks = $blockService->getPageBlocks($page->getId(), $site->getId());

		// Blocks modules
		$moduleService = new Services\Module();
		$modules = $moduleService->getModules();
		$modules->setBlock($blocks);
		$blocks->setModule($modules);

		// 3. Action stack
		foreach ($blocks as $block){
			var_dump();
			//$this->_helper->actionStack('index', 'index', $block->getModule()->getName());
		}

		// 4. Render
	}
}
