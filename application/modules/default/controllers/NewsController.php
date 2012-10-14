<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Default_NewsController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $newsRepository = $entityManager->getRepository('\Newsroom\Entity\News');
        $commentRepository = $entityManager->getRepository('\Newsroom\Entity\Comment');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_Blog(
                $this,
                $entityManager,
                $newsRepository,
                $commentRepository,
                new \Zend_Form($configForm->comment),
                'news'
        );
    }

    public function indexAction()
    {
        $this->view->headTitle('News');

        $this->service->get();
    }

    public function detailAction()
    {
        $this->service->detail();
    }
}
