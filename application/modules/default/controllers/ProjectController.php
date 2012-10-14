<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Default_ProjectController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $projectRepository = $entityManager->getRepository('\Newsroom\Entity\Project');
        $commentRepository = $entityManager->getRepository('\Newsroom\Entity\Comment');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_Blog(
                $this,
                $entityManager,
                $projectRepository,
                $commentRepository,
                new \Zend_Form($configForm->comment),
                'project'
        );
    }

    public function indexAction()
    {
        $this->view->headTitle('Projekte');

        $this->service->get();
    }

    public function detailAction()
    {
        $this->service->detail();
    }
}
