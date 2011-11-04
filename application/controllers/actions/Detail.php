<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_Detail extends \Controller_Action_Abstract
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
        $id = $this->_controller->getRequest()->getParam('id', null);

        try
        {
            $this->_controller->view->object = $this->_controller->getRepository()->fetchEntity($id);
        }
        catch (\Exception $e)
        {
            throw new \Controller_Action_Exception($e->getMessage(), 404);
        }
    }
}
