<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_CrudUser extends \Controller_Service_Crud
{
    protected function _preSave()
    {
        unset ($this->_values['password_repeat']);
    }
}
