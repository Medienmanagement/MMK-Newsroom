<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_AddContent extends \Controller_Action_Add
{
    protected function _preSave()
    {
        $this->_values['user'] = $this->_controller->getHelper('entityManager')->direct()->find(
                '\Newsroom\Entity\User',
                \Zend_Auth::getInstance()->getIdentity()->id
        );
    }
}
