<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_SingleEditContactInformation extends \Controller_Action_SingleEdit
{
    protected function _prepareForm()
    {
        $this->_form->image->setOrginValue($this->_entity->image);
    }
}
