<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_LecturerController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\Lecturer');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_CrudLecturer(
                $this,
                $entityManager,
                $repository,
                new \Zend_Form($configForm->lecturer),
                '/admin/lecturer'
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
