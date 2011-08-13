<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity\Repository;

class ContentRepository extends CrudRepository
{
    public function fetchEntityByUrl($url)
    {
        $entity = $this->findOneByUrl($url);

        if (! $entity instanceof $this->_entityName)
        {
            throw new \Exception('instanceof ' . $this->_entityName . ' failed');
        }

        return $entity;
    }

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
