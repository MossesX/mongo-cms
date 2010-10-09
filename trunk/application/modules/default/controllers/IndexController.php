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

		// Template
		$templateID = $page->getTemplateID() or $templateID = $site->getTemplateID();
		$templateService = new Services\Template();
		$template = $templateService->getTemplate($templateID);
		if (!$template)
			throw new Core\Exception("Template #$templateID doesn't exist");

		$site->setTemplate($template);
		$page->setTemplate($template);

		// Areas
		$areaService = new Services\Area();
		$areas = $areaService->getAreas($templateID);
		$blocks->setArea($areas);
		$areas->setTemplate($template);

		// Template layout
		$this->_helper->layout->setLayout($template->getLayout());

		// Action stack
		foreach ($blocks as $block){
			// Check if module is valid
			$moduleName = $block->getModule()->getName();
			if (!Zend_Controller_Front::getInstance()->getDispatcher()->isValidModule($moduleName))
				throw new Core\Cls\Exception("Module '$moduleName' is invalid");

			// Setting layout segment
			$this->getHelper('ViewRenderer')->setResponseSegment($block->getArea()->getName());

			// Appending action to stack
			// TODO: possibility to reassign controller and action for modules (maybe block options)
			$this->_helper->actionStack('index', 'index', $moduleName);
		}

		$this->getHelper('ViewRenderer')->setNoRender();

		//var_dump(\NS\Service\AbstractService::getDefaultAdapter()->getProfiler()->getQueryProfiles());
	}
}
