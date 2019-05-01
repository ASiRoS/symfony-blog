<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Service\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("", name="index")
     * @param PaginatorService $paginator
     * @return Response
     */
    public function index(PaginatorService $paginator): Response
    {
        $categories = $paginator->paginate(Category::class);

        return $this->render('category/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/{id}", name="show")
     * @param PaginatorService $paginator
     * @param Category $category
     * @return Response|NotFoundHttpException
     */
    public function show(PaginatorService $paginator, Category $category)
    {
        if(!$category->getPublished()) {
            return $this->createNotFoundException();
        }

        $posts = $this->getDoctrine()->getRepository(Post::class)->findAllActiveByCategory($category);
        $posts = $paginator->paginate($posts);

        return $this->render('category/show.html.twig', compact('category', 'posts'));
    }
}