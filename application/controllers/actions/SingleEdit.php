<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_SingleEdit extends \Controller_Action_Abstract
{
    protected $_entity = null;
    protected $_form = null;
    protected $_repository = null;
    protected $_values = null;

    public function __construct($controller)
    {
        if (!$controller instanceof \Controller_Action_InterfaceForm)
        {
            throw new \Controller_Action_Exception('instanceof \Controller_Action_InterfaceForm failed');
        }

        if (!$controller instanceof \Controller_Action_InterfaceRedirect)
        {
            throw new \Controller_Action_Exception('instanceof \Controller_Action_InterfaceRedirect failed');
        }

        parent::__construct($controller);
    }

    protected function _preSave()
    {
    }

    protected function _prepareForm()
    {
    }

    public function execute()
    {
        $this->_form = $this->_controller->getForm();
        $this->_repository = $this->_controller->getRepository();

        if ($this->_controller->getRequest()->isPost())
        {
            if ($this->_form->isValid($_POST))
            {
                try
                {
                    $this->_values = $this->_form->getValues();

                    $this->_preSave();
                    $id = $this->_repository->saveEntity($this->_values);
                    // needed, if no redirect occurs
                    // $this->_prepareForm();

                    $this->_controller->getHelper('systemMessages')->direct('notice', 'Speichervorgang erfolgreich');
                    $this->_controller->getHelper('redirector')->gotoUrl($this->_controller->getRedirect());
                }
                catch (\Exception $e)
                {
                    $log = $this->_controller->getInvokeArg('bootstrap')->log;
                    $log->log(
                            $e->getMessage(),
                            \Zend_Log::ERR,
                            array('trace' => $e->getTraceAsString())
                    );

                    $this->_controller->getHelper('systemMessages')->direct('error', 'Speichervorgang nicht erfolgreich');
                }
            }
        }
        else
        {
            $this->_entity = $this->_repository->fetchEntity();

            if ($this->_entity)
            {
                $this->_form->populate($this->_entity->toArray());
                $this->_prepareForm();
            }
        }

        $this->_form->setAction($this->_controller->getRedirect());
        $this->_controller->view->form = $this->_form;
    }
}
