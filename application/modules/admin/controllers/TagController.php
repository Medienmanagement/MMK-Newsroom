<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_TagController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new \Zend_Form($configForm->tag);
    }

    public function getRedirect()
    {
        return '/admin/tag';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Tag');
    }

    public function init()
    {
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
        \Controller_Action_Factory::get('edit', $this)->execute();
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('delete', $this)->execute();
    }
}
