<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $articles = $articleService->getPaginatedArticles(null);

        return $this->render('blog/home.html.twig', [
            'articles' => $articles,
            ]);
    }

    #[Route('/show/{slug}', name: 'app_show')]
    public function showArticle(Article $article): Response
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            ]);
    }
    #[Route('/about', name: 'app_about')]
    public function showAbout(): Response
    {
        return $this->render('about.html.twig');
    }
}
