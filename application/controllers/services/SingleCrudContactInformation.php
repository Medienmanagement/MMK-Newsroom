<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

class Controller_Service_SingleCrudContactInformation extends \Controller_Service_SingleCrud
{
    protected function _prepareForm()
    {
        $this->_form->image->setOrginValue($this->_entity->image);
    }
}
