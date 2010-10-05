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
		// Detect a site
		$arr = array(
			$this->_getParam('__siteID'),
			$this->_getParam('__siteName'),
			getenv('SITE_ID'),
			getenv('SITE_NAME')
		);
		sort($arr);
		$siteService = new Services\Site();
		$site = $siteService->getSite(array_pop($arr));
		if (!$site)
			throw new Core\Exception("Site detection error");

		// Detect page
		$pageID = $this->_getParam('__pageID');
		$pageService = new Services\Page();
		$page = $pageService->getPage($pageID, $site->getId()) or $page = $pageService->getPage404();
		if (!$page)
			throw new Core\Exception("Page #$pageID doesn't exist");
		$page->setSite($site);

		var_dump($page);

		// 3. Action stack

		// 4. Render
	}
}
