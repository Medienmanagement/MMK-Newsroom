<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_NewsController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new Form_TagForm($configForm->news);
    }

    public function getRedirect()
    {
        return '/admin/news';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\News');
    }

    public function indexAction()
    {
        \Controller_Action_Factory::get('list', $this)->execute();
    }

    public function addAction()
    {
        \Controller_Action_Factory::get('addContent', $this)->execute();
    }

    public function editAction()
    {
        \Controller_Action_Factory::get('editContent', $this)->execute();
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('delete', $this)->execute();
    }

    public function commentAction()
    {
        \Controller_Action_Factory::get('detail', $this)->execute();
    }

    public function commentDeleteAction()
    {
        \Controller_Action_Factory::get('deleteComment', $this)->execute();
    }
}
