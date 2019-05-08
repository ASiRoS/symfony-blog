<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PostRepository extends EntityRepository
{
    public function findAllActiveByCategory(Category $category): QueryBuilder
    {
        return $this
            ->createQueryBuilder('post')
            ->where('post.category = :category')
            ->andWhere('post.published = true')
            ->setParameter('category', $category)
        ;
    }

    public function findAllActiveByTag(Tag $tag): QueryBuilder
    {
        return $this
            ->createQueryBuilder('post')
            ->where(':tag MEMBER OF post.tags')
            ->andWhere('post.published = true')
            ->setParameter('tag', $tag)
        ;
    }
}