<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_DeleteComment extends \Controller_Action_Abstract
{
    public function __construct($controller)
    {
        if (!$controller instanceof \Controller_Action_InterfaceRedirect)
        {
            throw new \Controller_Action_Exception('instanceof \Controller_Action_InterfaceRedirect failed');
        }

        parent::__construct($controller);
    }

    public function execute()
    {
        $repository = $this->_controller->getHelper('entityManager')->direct()->getRepository('\Newsroom\Entity\Comment');

        $commentId = $this->_controller->getRequest()->getParam('id', null);

        try
        {
            $repository->deleteEntity($commentId);

            $this->_controller->getHelper('systemMessages')->direct('notice', 'Löschvorgang erfolgreich');
        }
        catch (\Exception $e)
        {
            $log = $this->_controller->getInvokeArg('bootstrap')->log;
            $log->log(
                    $e->getMessage(),
                    \Zend_Log::ERR,
                    array('trace' => $e->getTraceAsString())
            );

            $this->_controller->getHelper('systemMessages')->direct('error', 'Löschvorgang nicht erfolgreich');
        }

        $this->_controller->getHelper('redirector')->gotoUrl($this->_controller->getRedirect());
    }
}
