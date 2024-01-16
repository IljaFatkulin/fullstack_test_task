<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Exception\ProductOutOfStockException;
use App\Repository\Impl\OrderRepositoryImpl;
use App\Repository\Impl\ProductRepositoryImpl;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Service\OrderService;

class OrderServiceImpl implements OrderService
{
    private ProductRepository $productRepository;
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepositoryImpl();
        $this->orderRepository = new OrderRepositoryImpl();
    }

    /**
     * @param string $customerEmail
     * @param array $inputProducts
     * @return array
     * @throws ProductOutOfStockException
     */
    public function createOrder(string $customerEmail, array $inputProducts): array
    {
        $skuList = [];
        $productsArrayToSave = [];
        foreach ($inputProducts as $product) {
            $skuList[] = $product['product_id'];
            $productsArrayToSave[$product['product_id']] = ['id' => -1, 'quantity' => $product['quantity']];
        }

        $products = $this->productRepository->findBySkuArray($skuList);

        foreach ($products as $product) {
            if(!$product->isInStock()) {
                throw new ProductOutOfStockException($product->getSku());
            }
            $productsArrayToSave[$product->getSku()]['id'] = $product->getId();
        }

        return [
            'id' => $this->orderRepository->saveOrder($customerEmail, $productsArrayToSave)
        ];
    }
}