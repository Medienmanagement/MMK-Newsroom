<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_MaterialController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new Form_TagForm($configForm->material);
    }

    public function getRedirect()
    {
        return '/admin/material';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Material');
    }

    public function indexAction()
    {
        \Controller_Action_Factory::get('list', $this)->execute();
    }

    public function addAction()
    {
        \Controller_Action_Factory::get('add', $this)->execute();
    }

    public function editAction()
    {
        \Controller_Action_Factory::get('editPress', $this)->execute();
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('delete', $this)->execute();
    }
}
