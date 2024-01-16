<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\CategoryService;
use App\Service\Impl\CategoryServiceImpl;

class CategoryResolver
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryServiceImpl();
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args): array
    {
        $name = $args['name'] ?? null;
        if($name) {
            return $this->findByName($name);
        }

        return $this->findAll();
    }

    /**
     * @param $name
     * @return array
     */
    private function findByName($name): array
    {
        $category = $this->categoryService->findByName($name);
        if(!$category) {
            return array();
        }
        return array(['name' => $category->getName()]);
    }

    /**
     * @return array
     */
    private function findAll(): array
    {
        $categories = $this->categoryService->findAll();

        $response = [];
        foreach ($categories as $category) {
            $response[] = ['name' => $category->getName()];
        }

        return $response;
    }
}