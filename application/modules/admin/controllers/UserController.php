<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_UserController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new \Zend_Form($configForm->user);
    }

    public function getRedirect()
    {
        return '/admin/user';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\User');
    }

    public function indexAction()
    {
        \Controller_Action_Factory::get('list', $this)->execute();
    }

    public function addAction()
    {
        \Controller_Action_Factory::get('addUser', $this)->execute();
    }

    public function editAction()
    {
        \Controller_Action_Factory::get('editUser', $this)->execute();
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('delete', $this)->execute();
    }
}
