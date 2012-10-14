<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_Blog extends \Pkr_Service_Abstract
{
    /**
     * @var string
     */
    protected $_associationKey = null;

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
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $_repository = null;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $_commentRepository = null;

    /**
     * @var \Zend_Form
     */
    protected $_commentForm = null;

    public function __construct(
            \Zend_Controller_Action $controller,
            \Doctrine\ORM\EntityManager $entityManager,
            \Doctrine\ORM\EntityRepository $repository,
            \Doctrine\ORM\EntityRepository $commentRepository = null,
            \Zend_Form $commentForm = null,
            $associationKey = null
    )
    {
        $this->_controller = $controller;
        $this->_entityManager = $entityManager;
        $this->_repository = $repository;
        $this->_commentRepository = $commentRepository;
        $this->_commentForm = $commentForm;
        $this->_associationKey = $associationKey;
    }

    protected function _handleMeta()
    {
        $view = $this->_controller->view;
        $view->headTitle($this->_entity->headline);

        $author = '';
        if (!empty ($this->_entity->user->title))
        {
            $author = $this->_entity->user->title . ' ';
        }
        $author .= $this->_entity->user->firstname . ' ' . $this->_entity->user->lastname;
        $view->headMeta()->setName('author', $author);

        $markdown = new \Markdown\Adapter();
        $description = $markdown->markdown($this->_entity->content);
        $description = strip_tags($description);
        $description = $this->_controller->getHelper('truncate')->direct($description, 255);
        $view->headMeta()->setName('description', $description);
    }

    protected function _handleComment()
    {
        $this->_entityManager->getConnection()->beginTransaction();

        try
        {
            $values = $this->_commentForm->getValues();
            unset($values['csrf']);
            unset($values['firstname']); # SpamDetection
            $values[$this->_associationKey] = $this->_entity;
            $this->_commentRepository->saveEntity($values);

            $mail = new \Zend_Mail('UTF-8');
            $mail->setFromToDefaultFrom();
            $mail->addTo($this->_entity->user->login);
            $mail->setSubject('Kommentar zu "' . $this->_entity->headline . '"');
            $body  = $values['name'] . ' (' . $values['email'] . ') schrieb folgendes:';
            $body .= "\n\n" . $values['content'];
            $mail->setBodyText($body);
            $mail->send();

            $this->_commentForm->reset();

            $this->_entityManager->getConnection()->commit();

            # $this->_controller->getHelper('systemMessages')->direct('notice', 'Kommentar erfolgreich gespeichert');
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

            # $this->_controller->getHelper('systemMessages')->direct('error', 'Kommentar konnte nicht gespeichert werden');
        }
    }

    public function get()
    {
        $paginator = \Zend_Paginator::factory($this->_repository->fetchEntities());
        $paginator->setItemCountPerPage(9);
        $paginator->setCurrentPageNumber($this->_controller->getRequest()->getParam('page'));

        $this->_controller->view->paginator = $paginator;
    }

    public function detail()
    {
        $url = $this->_controller->getRequest()->getParam('url', null);

        try
        {
            $this->_entity = $this->_repository->fetchEntityByUrl($url);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage(), 404);
        }

        $this->_handleMeta();

        $this->_controller->view->object = $this->_entity;

        if ($this->_commentRepository && $this->_commentForm && $this->_associationKey)
        {
            if ($this->_controller->getRequest()->isPost())
            {
                if ($this->_commentForm->isValid($_POST))
                {
                    $this->_handleComment();
                }
            }

            $this->_controller->view->form = $this->_commentForm;
        }
    }
}
