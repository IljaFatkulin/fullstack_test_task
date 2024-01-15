<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\Impl\OrderServiceImpl;
use App\Service\OrderService;

class OrderResolver
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderServiceImpl();
    }

    public function resolve($root, $args): array
    {
        var_dump($args);
        $this->orderService->createOrder($args['customer_email'], $args['products']);
        return [];
    }
}