<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use App\Service\PaginatorService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tags", name="tags_post")
     * @param Request $request
     * @param PaginatorService $paginator
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @return Response
     */
    public function search(Request $request, PaginatorService $paginator): Response
    {
        $search = $request->get('q');

        $manager = $this->getDoctrine();
        $tag = $manager->getRepository(Tag::class)->searchBy($search)->getSingleResult();

        $posts = $manager->getRepository(Post::class)->findAllActiveByTag($tag);
        $posts = $paginator->paginate($posts);

        return $this->render('post/index.html.twig', compact('posts'));
    }
}