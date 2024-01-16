<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Product;

interface OrderRepository
{
    /**
     * @param string $customerEmail
     * @param Product[] $products
     * @return string
     */
    public function saveOrder(string $customerEmail, array $products): string;
}