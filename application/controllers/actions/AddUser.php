<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Action_AddUser extends \Controller_Action_Add
{
    protected function _preSave()
    {
        unset ($this->_values['password_repeat']);
    }
}
