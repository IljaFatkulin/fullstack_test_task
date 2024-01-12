<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\Impl\ProductServiceImpl;
use App\Service\ProductService;

class ProductResolver
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductServiceImpl();
    }

    /**
     * @return array
     */
    public function resolve(): array
    {
        $products = $this->productService->findAll();

        $response = [];
        foreach ($products as $product) {
            $response[] = [
                'id' => $product->getSku(),
                'name' => $product->getName(),
                'inStock' => $product->isInStock(),
                'description' => $product->getDescription(),
                'category' => $product->getSubcategory()->getName(),
                'brand' => $product->getBrand()->getName()
            ];
        }

        return  $response;
    }
}