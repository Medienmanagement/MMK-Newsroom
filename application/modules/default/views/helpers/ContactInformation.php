<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Zend_View_Helper_ContactInformation extends \Zend_View_Helper_Abstract
{
    protected $_entity = null;

    public function __construct()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');

        $entityManager = $bootstrap->getResource('doctrine')->getEntityManager();
        $this->_entity = $entityManager->getRepository('\Newsroom\Entity\ContactInformation')->fetchEntity();
    }

    public function contactInformation()
    {
        return $this->_entity;
    }
}
