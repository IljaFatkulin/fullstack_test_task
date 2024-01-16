<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Exception\ProductOutOfStockException;
use App\Service\Impl\OrderServiceImpl;
use App\Service\OrderService;
use GraphQL\Error\UserError;

class OrderResolver
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderServiceImpl();
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args): array
    {
        try {
            return $this->orderService->createOrder($args['customer_email'], $args['products']);
        } catch (ProductOutOfStockException $e) {
            throw new UserError($e->getMessage());
        }
    }
}