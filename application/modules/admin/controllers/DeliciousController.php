<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_DeliciousController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new \Zend_Form($configForm->deliciousApi);
    }

    public function getRedirect()
    {
        return '/admin/delicious';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Delicious');
    }

    public function indexAction()
    {
        \Controller_Action_Factory::get('singleEdit', $this)->execute();
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('singleDelete', $this)->execute();
    }
}
