<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_Lecturer extends \Controller_Service_Blog
{
    protected function _handleMeta()
    {
        $view = $this->_controller->view;

        $title = '';
        if (!empty ($this->_entity->title))
        {
            $title = $this->_entity->title . ' ';
        }
        $title .= $this->_entity->firstname . ' ' . $this->_entity->lastname;
        $view->headTitle($title);

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

    public function get()
    {
        $this->_controller->view->objects = $this->_repository->fetchEntities();
    }
}
