<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Default_PressController extends \Zend_Controller_Action
{
    public function init()
    {
        $this->announcementRepository = $this->_helper
                                             ->entityManager()
                                             ->getRepository('\Newsroom\Entity\Announcement');

        $this->materialRepository = $this->_helper
                                         ->entityManager()
                                         ->getRepository('\Newsroom\Entity\Material');
    }

    public function indexAction()
    {
        $this->view->headTitle('Presse');

        $this->view->announcements = $this->announcementRepository->fetchEntities();
        $this->view->materials = $this->materialRepository->fetchEntities();
    }
}
