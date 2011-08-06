<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity\Repository;

/**
 * AnnouncementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnouncementRepository extends CrudRepository
{
    public function fetchEntities($limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->orderBy('e.publish', 'desc');

        if (!empty ($limit))
        {
            $qb->setMaxResults($limit);
        }

        if (!empty ($offset))
        {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->execute();
    }

    public function saveEntity(array $data)
    {
        $data['update'] = new \DateTime();

        return parent::saveEntity($data);
    }
}
