<?php
declare(strict_types=1);

namespace App\Service;

interface OrderService
{
    /**
     * @param string $customerEmail
     * @param array $products
     * @return mixed
     */
    // $products should be ['product_id' => 'quantity'], for example ['5' => '2']
    public function createOrder(string $customerEmail, array $products);
}