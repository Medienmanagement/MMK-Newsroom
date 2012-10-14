<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_UserController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\User');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_CrudUser(
                $this,
                $entityManager,
                $repository,
                new \Zend_Form($configForm->user),
                '/admin/user'
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
}
