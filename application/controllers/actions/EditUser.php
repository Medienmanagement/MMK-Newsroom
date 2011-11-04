<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_EditUser extends \Controller_Action_Edit
{
    protected function _preSave()
    {
        unset ($this->_values['password_repeat']);
    }
}
