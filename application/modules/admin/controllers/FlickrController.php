<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_FlickrController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\Flickr');
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_SingleCrud(
                $this,
                $entityManager,
                $repository,
                new \Zend_Form($configForm->flickrApi),
                '/admin/flickr'
        );
    }

    public function indexAction()
    {
        $this->service->edit();
    }

    public function deleteAction()
    {
        $this->service->delete();
    }
}
