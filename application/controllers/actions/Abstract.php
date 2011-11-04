<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

abstract class Controller_Action_Abstract
{
    protected $_controller = null;

    public function __construct($controller)
    {
        if (!$controller instanceof \Zend_Controller_Action)
        {
            throw new \Controller_Action_Exception('instanceof \Zend_Controller_Action failed');
        }

        $this->_controller = $controller;
    }

    abstract function execute();
}
