<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Service\OrderService;

class OrderServiceImpl implements OrderService
{
    /**
     * @param string $customerEmail
     * @param array $products
     * @return array
     */
    public function createOrder(string $customerEmail, array $products): array
    {
        return [
            'id' => '1',
            'customer_email' => 'ilja',
            'products' => [
                [
                    'product_id' => '3',
                    'quantity' => 33
                ],
                [
                    'product_id' => '4',
                    'quantity' => 44
                ]
            ]
        ];
    }
}