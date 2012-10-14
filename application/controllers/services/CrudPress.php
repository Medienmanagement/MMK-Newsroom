<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_CrudPress extends \Controller_Service_Crud
{
    protected function _prepareForm()
    {
        $this->_form->file->setOrginValue($this->_entity->file);
    }
}
