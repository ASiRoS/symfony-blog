<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class TagRepository extends EntityRepository
{
    public function searchBy(string $tagName): Query
    {
        return $this->createQueryBuilder('tag')
            ->where('tag.title LIKE :tagName')
            ->andWhere('tag.published = true')
            ->setParameter('tagName', "%$tagName%")
            ->getQuery();
    }
}