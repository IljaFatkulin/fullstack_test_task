<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Model\Category\Category;
use App\Repository\CategoryRepository;
use App\Repository\Impl\CategoryRepositoryImpl;
use App\Service\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepositoryImpl();
    }

    public function findAll(): array
    {
        return $this->categoryRepository->findAll();
    }

    public function findByName(string $name): ?Category
    {
        return $this->categoryRepository->findByName($name);
    }
}