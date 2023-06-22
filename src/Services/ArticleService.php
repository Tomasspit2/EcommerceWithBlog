<?php

namespace App\Services;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ArticleService
{
    public function __construct(
        private RequestStack $requestStack,
        private ArticleRepository $articleRepository,
        private PaginatorInterface $paginator
    )
    {
    }

    public function getPaginatedArticles(?Category $category = null)
    {

        $request = $this->requestStack->getMainRequest();

        $page = $request->query->getInt('page', 1);
        $limit = 16;

        $articlesQuery = $this->articleRepository->findForPagination($category);

        return $this->paginator->paginate($articlesQuery, $page, $limit);
    }
}