<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use InvalidArgumentException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginatorService
{
    private const QUERY_PARAM_KEY = 'page';

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var Request
     */
    private $request;

    public function __construct(PaginatorInterface $paginator, EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->paginator = $paginator;
        $this->manager = $manager;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function paginate($classOrQuery)
    {
        $query = $this->getQuery($classOrQuery);

        return $this->paginator->paginate($query, $this->getPage());
    }

    private function getPage(): int
    {
        return $this->request->query->getInt(self::QUERY_PARAM_KEY, 1);
    }

    /**
     * @param string|QueryBuilder $classOrQuery
     * @return QueryBuilder
     */
    private function getQuery($classOrQuery): QueryBuilder
    {
        if(is_string($classOrQuery)) {
            $classOrQuery = $this->manager->getRepository($classOrQuery)->createQueryBuilder('r');
        } elseif(!$classOrQuery instanceof QueryBuilder) {
            throw new InvalidArgumentException('Paginator can work only with string and queries!');
        }

        return $classOrQuery;
    }
}