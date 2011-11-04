<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Admin_TwitterController
    extends \Zend_Controller_Action
    implements \Controller_Action_InterfaceRepository, \Controller_Action_InterfaceRedirect
{
    public function getRedirect()
    {
        return '/admin/twitter';
    }

    public function getRepository()
    {
        return $this->_helper->entityManager()->getRepository('\Newsroom\Entity\Twitter');
    }

    public function init()
    {
    }

    public function indexAction()
    {
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
                try
                {
                    $this->getRepository()->saveEntity($twitterApiForm->getValues());

                    $oauthConfig['consumerKey'] = $twitterApiForm->getValue('consumerKey');
                    $oauthConfig['consumerSecret'] = $twitterApiForm->getValue('consumerSecret');

                    $consumer = new \Zend_Oauth_Consumer($oauthConfig);
                    $token = $consumer->getRequestToken();
                    $session->twitterRequestToken = serialize($token);
                    $consumer->redirect();
                }
                catch (\Exception $e)
                {
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
            try
            {
                $entity = $this->getRepository()->fetchEntity();

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

                        $this->getRepository()->saveEntity(
                            array('accessToken' => serialize($token))
                        );

                        unset($session->twitterRequestToken);

                        $this->_helper->systemMessages('notice', 'Speichervorgang erfolgreich');
                        $this->_redirect($this->getRedirect());
                    }
                    $twitterApiForm->populate($entity->toArray());
                }
            }
            catch (\Exception $e)
            {
                $log = $this->getInvokeArg('bootstrap')->log;
                $log->log(
                        $e->getMessage(),
                        \Zend_Log::ERR,
                        array('trace' => $e->getTraceAsString())
                );

                $this->_helper->systemMessages('error', 'Speichervorgang nicht erfolgreich');
            }
        }

        $twitterApiForm->setAction($this->getRedirect());
        $this->view->form = $twitterApiForm;
    }

    public function deleteAction()
    {
        \Controller_Action_Factory::get('singleDelete', $this)->execute();
    }
}
