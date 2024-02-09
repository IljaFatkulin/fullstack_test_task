<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Model\Product;
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
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args): array
    {
        if(isset($args['id'])) {
            return $this->findById($args['id']);
        }

        if(isset($args['categoryName'])) {
            return $this->findByCategory($args['categoryName']);
        }

        return $this->findAll();
    }

    /**
     * @return array
     */
    private function findAll(): array
    {
        $products = $this->productService->findAll();

        $response = [];
        foreach ($products as $product) {
            $response[] = $this->convertObjectToResponse($product);
        }

        return  $response;
    }

    /**
     * @param string $id
     * @return array
     */
    private function findById(string $id): array
    {
        $product = $this->productService->findBySkuArray([$id]);
        if(!$product) {
            return [];
        }
        return array($this->convertObjectToResponse($product[0]));
    }

    /**
     * @param string $categoryName
     * @return array
     */
    private function findByCategory(string $categoryName): array
    {
        $products = $this->productService->findByCategory($categoryName);

        $response = [];
        foreach ($products as $product) {
            $response[] = $this->convertObjectToResponse($product);
        }
        return $response;
    }

    /**
     * @param Product $product
     * @return array
     */
    private function convertObjectToResponse(Product $product): array
    {
        var_dump($product);
        return [
            'id' => $product->getSku(),
            'name' => $product->getName(),
            'inStock' => $product->isInStock(),
            'description' => $product->getDescription(),
            'category' => $product->getSubcategory()->getName(),
            'brand' => $product->getBrand()->getName()
        ];
    }
}