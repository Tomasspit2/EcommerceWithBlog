<?php 

namespace App\Services;

use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CommentService

{


    public function __construct(
        private RequestStack $requestStack,
        private PaginatorInterface $paginator,
        private CommentRepository $commentRepository,
    )
    {
    }

    public function getPaginatedComments(?Article $article = null): PaginationInterface
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 2;

        $commentsQuery = $this->commentRepository->findForPaginationComments($article);

        return $this->paginator->paginate($commentsQuery, $page, $limit);

    }
}