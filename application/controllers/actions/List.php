<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_List extends \Controller_Action_Abstract
{
    public function __construct($controller)
    {
        if (!$controller instanceof \Controller_Action_InterfaceRepository)
        {
            throw new \Controller_Action_Exception('instanceof \Controller_Action_InterfaceRepository failed');
        }

        parent::__construct($controller);
    }

    public function execute()
    {
        $this->_controller->view->objects = $this->_controller->getRepository()->fetchEntities();
    }
}
