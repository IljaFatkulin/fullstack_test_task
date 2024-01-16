<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Model\Product;
use App\Repository\Impl\ProductRepositoryImpl;
use App\Repository\ProductRepository;
use App\Service\ProductService;

class ProductServiceImpl implements ProductService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepositoryImpl();
    }

    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        return $this->productRepository->findAll();
    }

    /**
     * @param string $name
     * @return Product|null
     */
    public function findByName(string $name): ?Product
    {
        return $this->productRepository->findByName($name);
    }

    public function findBySkuArray(array $skuList): array
    {
        return $this->productRepository->findBySkuArray($skuList);
    }

    public function findByCategory(string $categoryName): array
    {
        return $this->productRepository->findByCategory($categoryName);
    }
}