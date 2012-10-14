<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Default_LecturerController extends \Zend_Controller_Action
{
    public function init()
    {
        $entityManager = $this->_helper->entityManager();
        $repository = $entityManager->getRepository('\Newsroom\Entity\Lecturer');

        $this->service = new \Controller_Service_Lecturer(
                $this,
                $entityManager,
                $repository
        );
    }

    public function indexAction()
    {
        $this->view->headTitle('Dozenten');

        $this->service->get();
    }

    public function detailAction()
    {
        $this->service->detail();
    }
}
