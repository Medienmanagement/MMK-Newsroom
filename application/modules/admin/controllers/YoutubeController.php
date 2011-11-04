<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_YoutubeController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceForm, \Controller_Action_InterfaceRedirect
{
    public function init()
    {
    }

    public function getForm()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        return new \Zend_Form($configForm->youtubeApi);
    }

    public function getRedirect()
    {
        return '/admin/youtube';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Youtube');
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
