<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity\Repository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends CrudRepository
{
    public function fetchEntities()
    {
        $qb = $this->createQueryBuilder('e');
        $qb->orderBy('e.name', 'asc');

        return $qb->getQuery()->execute();
    }
}