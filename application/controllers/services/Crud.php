<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_Crud extends \Pkr_Service_Abstract
{
    /**
     * @var \Zend_Controller_Action
     */
    protected $_controller = null;

    /**
     * @var \Newsroom\EntityAbstract
     */
    protected $_entity = null;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_entityManager = null;

    /**
     * @var \Zend_Form
     */
    protected $_form = null;

    /**
     * @var String
     */
    protected $_redirect = null;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $_repository = null;

    /**
     * @var Array
     */
    protected $_values = null;

    public function __construct(
            \Zend_Controller_Action $controller,
            \Doctrine\ORM\EntityManager $entityManager,
            \Doctrine\ORM\EntityRepository $repository,
            \Zend_Form $form,
            $redirect
    )
    {
        $this->_controller = $controller;
        $this->_entityManager = $entityManager;
        $this->_repository = $repository;
        $this->_form = $form;
        $this->_redirect = $redirect;
    }

    protected function _preSave()
    {
    }

    protected function _prepareForm()
    {
    }

    public function get()
    {
        $this->_controller->view->objects = $this->_repository->fetchEntities();
    }

    public function detail()
    {
        $id = $this->_controller->getRequest()->getParam('id', null);

        try
        {
            $this->_controller->view->object = $this->_repository->fetchEntity($id);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage(), 404);
        }
    }

    public function add()
    {
        if ($this->_controller->getRequest()->isPost())
        {
            if ($this->_form->isValid($_POST))
            {
                $this->_entityManager->getConnection()->beginTransaction();

                try
                {
                    $this->_values = $this->_form->getValues();

                    $this->_preSave();
                    $id = $this->_repository->saveEntity($this->_values);

                    $this->_entityManager->getConnection()->commit();

                    $this->_controller->getHelper('systemMessages')->direct('notice', 'Speichervorgang erfolgreich');
                    $this->_controller->getHelper('redirector')->gotoUrl($this->_redirect);
                }
                catch (\Exception $e)
                {
                    $this->_entityManager->getConnection()->rollback();

                    if (self::$_log)
                    {
                        self::$_log->log(
                                $e->getMessage(),
                                \Zend_Log::ERR,
                                array('trace' => $e->getTraceAsString())
                        );
                    }

                    $this->_controller->getHelper('systemMessages')->direct('error', 'Speichervorgang nicht erfolgreich');
                }
            }
        }

        $this->_form->setAction($this->_redirect . '/add');
        $this->_controller->view->form = $this->_form;
    }

    public function edit()
    {
        $id = $this->_controller->getRequest()->getParam('id', null);

        try
        {
            $this->_entity = $this->_repository->fetchEntity($id);
            $this->_prepareForm();
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage(), 404);
        }

        if ($this->_controller->getRequest()->isPost())
        {
            if ($this->_form->isValid($_POST))
            {
                $this->_entityManager->getConnection()->beginTransaction();

                try
                {
                    $this->_values = $this->_form->getValues();

                    $this->_preSave();
                    $id = $this->_repository->saveEntity($this->_values);
                    // needed, if no redirect occurs
                    // $this->_prepareForm();

                    $this->_entityManager->getConnection()->commit();

                    $this->_controller->getHelper('systemMessages')->direct('notice', 'Speichervorgang erfolgreich');
                    $this->_controller->getHelper('redirector')->gotoUrl($this->_redirect);
                }
                catch (\Exception $e)
                {
                    $this->_entityManager->getConnection()->rollback();

                    if (self::$_log)
                    {
                        self::$_log->log(
                                $e->getMessage(),
                                \Zend_Log::ERR,
                                array('trace' => $e->getTraceAsString())
                        );
                    }

                    $this->_controller->getHelper('systemMessages')->direct('error', 'Speichervorgang nicht erfolgreich');
                }
            }
        }
        else
        {
            $this->_form->populate($this->_entity->toArray());
        }

        $this->_form->setAction($this->_redirect . '/edit/' . $id);
        $this->_controller->view->form = $this->_form;
    }

    public function delete()
    {
        $id = $this->_controller->getRequest()->getParam('id', null);

        $this->_entityManager->getConnection()->beginTransaction();
        try
        {
            $this->_repository->deleteEntity($id);
            $this->_entityManager->getConnection()->commit();

            $this->_controller->getHelper('systemMessages')->direct('notice', 'Löschvorgang erfolgreich');
        }
        catch (\Exception $e)
        {
            $this->_entityManager->getConnection()->rollback();

            if (self::$_log)
            {
                self::$_log->log(
                        $e->getMessage(),
                        \Zend_Log::ERR,
                        array('trace' => $e->getTraceAsString())
                );
            }

            $this->_controller->getHelper('systemMessages')->direct('error', 'Löschvorgang nicht erfolgreich');
        }

        $this->_controller->getHelper('redirector')->gotoUrl($this->_redirect);
    }
}
