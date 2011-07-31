<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity\Repository;

/**
 * FileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FileRepository extends CrudRepository
{
    public function saveEntity(array $data)
    {
        $data['update'] = new \DateTime();

        return parent::saveEntity($data);
    }
}