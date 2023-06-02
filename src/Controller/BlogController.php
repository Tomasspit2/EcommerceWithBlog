<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('blog/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            ]);
    }

    #[Route('/show/{slug}', name: 'app_show')]
    public function showArticle(Article $article, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'categories' => $categories,
            ]);
    }
}
