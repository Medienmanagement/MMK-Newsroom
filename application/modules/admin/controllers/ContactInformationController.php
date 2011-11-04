<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_ContactInformationController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new \Zend_Form($configForm->contactInformation);
    }

    public function getRedirect()
    {
        return '/admin/contact-information';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\ContactInformation');
    }

    public function indexAction()
    {
        \Controller_Action_Factory::get('singleEditContactInformation', $this)->execute();
    }
}
