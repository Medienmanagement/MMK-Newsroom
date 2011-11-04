<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

abstract class Controller_Action_Factory
{
    public static function get($className, $controller)
    {
        if (!is_string ($className) || !trim ($className))
        {
            throw new \Controller_Action_Exception('no valid class name');
        }

        try
        {
            $name = 'Controller_Action_' . ucfirst($className);

            $object = new $name($controller);

            return $object;
        }
        catch (\Exception $e)
        {
            throw new \Controller_Action_Exception($e->getMessage());
        }
    }
}
