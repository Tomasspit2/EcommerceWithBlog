<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CategoryService   {

    private $categoryRepository;
    private $requestStack;

    public function __construct(RequestStack $requestStack, CategoryRepository $categoryRepository)
    {
        $this->requestStack = $requestStack;
        $this->categoryRepository = $categoryRepository;
    }

    public function updateSession()
    {
        $session = $this->requestStack->getSession();
        $categories = $this->categoryRepository->findAll();
        $session->set('categories', $categories);
    }
}