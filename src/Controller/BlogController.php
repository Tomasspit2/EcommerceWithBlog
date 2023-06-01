<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, Request $request): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();

        $session = $request->getSession();
        $session->set('categories', $categories);

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
}
