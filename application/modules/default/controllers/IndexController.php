<?php

use NS\Modules\Core\Services;

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

		// 2. Detect page

		// 3. Action stack

		// 4. Render

		
		die();
	}


}

