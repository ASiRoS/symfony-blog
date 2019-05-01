<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CommentRepository extends EntityRepository
{
    public function findPublishedByPost(Post $post): QueryBuilder
    {
        return $this
            ->createQueryBuilder('comment')
            ->where('comment.post = :post')
            ->andWhere('comment.published = true')
            ->setParameter('post', $post)
            ;
    }
}