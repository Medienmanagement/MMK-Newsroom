<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_TwitterController extends \Zend_Controller_Action
{
    /**
     * @var type \Doctrine\ORM\EntityRepository
     */
    protected $_repository = null;

    protected function _getRedirect()
    {
        return '/admin/twitter';
    }

    protected function _getRepository()
    {
        if (null === $this->_repository)
        {
            $this->_repository = $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Twitter');
        }

        return $this->_repository;
    }

    public function init()
    {
        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');

        $this->service = new \Controller_Service_SingleCrud(
                $this,
                $this->_helper->entityManager(),
                $this->_getRepository(),
                new \Zend_Form($configForm->twitterApi),
                $this->_getRedirect()
        );
    }

    public function indexAction()
    {
        $entityManager = $this->_helper->entityManager();
        $session = new \Zend_Session_Namespace('twitter', true);

        $oauthConfig = array(
            'callbackUrl'    => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
            'siteUrl'        => 'http://twitter.com/oauth'
        );

        $configForm = $this->getInvokeArg('bootstrap')->getResource('configForm');
        $twitterApiForm = new \Zend_Form($configForm->twitterApi);

        if ($this->getRequest()->isPost())
        {
            if ($twitterApiForm->isValid($_POST))
            {
                $entityManager->getConnection()->beginTransaction();
                try
                {
                    $this->_getRepository()->saveEntity($twitterApiForm->getValues());

                    $oauthConfig['consumerKey'] = $twitterApiForm->getValue('consumerKey');
                    $oauthConfig['consumerSecret'] = $twitterApiForm->getValue('consumerSecret');

                    $consumer = new \Zend_Oauth_Consumer($oauthConfig);
                    $token = $consumer->getRequestToken();
                    $session->twitterRequestToken = serialize($token);

                    $entityManager->getConnection()->commit();

                    $consumer->redirect();
                }
                catch (\Exception $e)
                {
                    $entityManager->getConnection()->rollback();

                    $log = $this->getInvokeArg('bootstrap')->log;
                    $log->log(
                            $e->getMessage(),
                            \Zend_Log::ERR,
                            array('trace' => $e->getTraceAsString())
                    );

                    $this->_helper->systemMessages('error', 'Einstellungen konnte nicht gespeichert werden');
                }
            }
        }
        else
        {
            $entityManager->getConnection()->beginTransaction();
            try
            {
                $entity = $this->_getRepository()->fetchEntity();

                if ($entity)
                {
                    if (isset($session->twitterRequestToken))
                    {
                        $oauthConfig['consumerKey'] = $entity->consumerKey;
                        $oauthConfig['consumerSecret'] = $entity->consumerSecret;

                        $consumer = new \Zend_Oauth_Consumer($oauthConfig);
                        $token = $consumer->getAccessToken(
                            $_GET,
                            unserialize($session->twitterRequestToken)
                        );

                        $this->_getRepository()->saveEntity(
                            array('accessToken' => serialize($token))
                        );

                        unset($session->twitterRequestToken);

                        $entityManager->getConnection()->commit();

                        $this->_helper->systemMessages('notice', 'Speichervorgang erfolgreich');
                        $this->_redirect($this->_getRedirect());
                    }
                    $twitterApiForm->populate($entity->toArray());
                }
            }
            catch (\Exception $e)
            {
                $entityManager->getConnection()->rollback();

                $log = $this->getInvokeArg('bootstrap')->log;
                $log->log(
                        $e->getMessage(),
                        \Zend_Log::ERR,
                        array('trace' => $e->getTraceAsString())
                );

                $this->_helper->systemMessages('error', 'Speichervorgang nicht erfolgreich');
            }
        }

        $twitterApiForm->setAction($this->_getRedirect());
        $this->view->form = $twitterApiForm;
    }

    public function deleteAction()
    {
        $this->service->delete();
    }
}
