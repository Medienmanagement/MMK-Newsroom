<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Default_EventController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $eventRepository = $entityManager->getRepository('\Newsroom\Entity\Event');
        $commentRepository = $entityManager->getRepository('\Newsroom\Entity\Comment');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_Blog(
                $this,
                $entityManager,
                $eventRepository,
                $commentRepository,
                new \Zend_Form($configForm->comment),
                'event'
        );
    }

    public function indexAction()
    {
        $this->view->headTitle('Events');

        $this->service->get();
    }

    public function detailAction()
    {
        $this->service->detail();
    }
}
