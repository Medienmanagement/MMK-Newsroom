<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_ContactInformationController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\ContactInformation');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_SingleCrudContactInformation(
                $this,
                $entityManager,
                $repository,
                new \Zend_Form($configForm->contactInformation),
                '/admin/contact-information'
        );
    }

    public function indexAction()
    {
        $this->service->edit();
    }
}
