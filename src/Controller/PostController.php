<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Service\PaginatorService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts", name="post_")
 */
class PostController extends AbstractController
{
    /**
     * @Template()
     * @Route("", name="index", methods={"GET"})
     * @param PaginatorService $paginator
     * @return array
     */
    public function index(PaginatorService $paginator): array
    {
        $posts = $paginator->paginate(Post::class);

        return compact('posts');
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Post $post
     * @param PaginatorService $paginator
     * @return Response|NotFoundHttpException
     */
    public function show(PaginatorService $paginator, Post $post)
    {
        if(!$post->getPublished()) {
            return $this->createNotFoundException();
        }

        $comments = $this->getDoctrine()->getRepository(Comment::class)->findPublishedByPost($post);
        $comments = $paginator->paginate($comments);

        $commentForm = $this->createForm(CommentType::class)->createView();

        return $this->render('post/show.html.twig', compact('post', 'comments', 'commentForm'));
    }

    /**
     * @Route("/{id}/comment", name="comment", methods={"POST"})
     * @param Post $post
     * @param Request $request
     * @Security("has_role('ROLE_USER')")
     * @return RedirectResponse
     */
    public function comment(Request $request, Post $post): RedirectResponse
    {
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if($form->isValid()) {
            /** @var Comment $comment */
            $comment = $form->getData();

            $comment->setAuthor($this->getUser());
            $comment->setPost($post);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($comment);
            $manager->flush();
        }

        return $this->redirectToRoute('post_show', ['id' => $post->getId(), 'form' => $form->createView()]);
    }
}