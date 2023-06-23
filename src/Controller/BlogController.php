<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Services\ArticleService;
use App\Services\CommentService;
use App\Services\CategoryService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(CategoryService $categoryService)
    {
        $categoryService->updateSession();
    }
    
    #[Route('/', name: 'app_home')]
    public function home(ArticleService $articleService): Response
    {
        $articles = $articleService->getPaginatedArticles();

        return $this->render('blog/home.html.twig', [
            'articles' => $articles,
            ]);
    }

    #[Route('/show/{slug}', name: 'app_show')]
    public function showArticle(Article $article, Request $request, CommentRepository $commentRepository, CommentService $commentService): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new DateTimeImmutable());
            $comment->setUser($this->getUser());
            $comment->setArticle($article);
            $commentRepository->save($comment, true);

            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
        }

        return $this->renderForm('blog/show.html.twig', [
            'article' => $article,
            'comments' => $commentService->getPaginatedComments($article),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function showAbout(): Response
    {
        return $this->render('about.html.twig');
    }
}
