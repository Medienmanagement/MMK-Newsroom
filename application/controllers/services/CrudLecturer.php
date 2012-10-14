<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_CrudLecturer extends \Controller_Service_CrudContent
{
    protected function _preSave()
    {
        parent::_preSave();

        $filter = new \Pkr_Filter_Url();

        $name = $this->_values['firstname'] . ' ' . $this->_values['lastname'];

        if (!empty ($this->_values['title']))
        {
            $name = $this->_values['title'] . ' ' . $name;
        }

        $this->_values['url'] = $filter->filter($name);
    }
}
