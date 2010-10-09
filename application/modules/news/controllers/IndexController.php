<?php

class News_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		var_dump($this->_helper->viewRenderer->render());

		$this->view->render('index.phtml');
    }


}

