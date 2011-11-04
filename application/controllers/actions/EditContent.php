<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_EditContent extends \Controller_Action_Edit
{
    protected function _preSave()
    {
        $this->_values['user'] = $this->_controller->getHelper('entityManager')->direct()->find(
                '\Newsroom\Entity\User',
                \Zend_Auth::getInstance()->getIdentity()->id
        );
    }

    protected function _prepareForm()
    {
        $this->_form->image->setOrginValue($this->_entity->image);
    }
}
