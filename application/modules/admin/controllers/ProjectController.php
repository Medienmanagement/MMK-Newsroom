<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_ProjectController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\Project');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_CrudContent(
                $this,
                $entityManager,
                $repository,
                new \Form_TagForm($configForm->project),
                '/admin/project'
        );
    }

    public function indexAction()
    {
        $this->service->get();
    }

    public function addAction()
    {
        $this->service->add();
    }

    public function editAction()
    {
        $this->service->edit();
    }

    public function deleteAction()
    {
        $this->service->delete();
    }

    public function commentAction()
    {
        $this->service->detail();
    }

    public function commentDeleteAction()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\Comment');

        $service = new \Controller_Service_Crud(
                $this,
                $entityManager,
                $repository,
                new \Zend_Form(),
                '/admin/project'
        );

        $service->delete();
    }
}
