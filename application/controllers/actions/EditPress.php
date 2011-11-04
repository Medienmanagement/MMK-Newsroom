<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_EditPress extends \Controller_Action_Edit
{
    protected function _prepareForm()
    {
        $this->_form->file->setOrginValue($this->_entity->file);
    }
}
