<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PostRepository extends EntityRepository
{
    public function findAllActiveByCategory(Category $category): QueryBuilder
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.category = :category')
            ->andWhere('r.published = true')
            ->setParameter('category', $category)
        ;
    }
}