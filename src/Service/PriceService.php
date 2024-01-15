<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Price;

interface PriceService
{
    /**
     * @param string $sku
     * @return Price[]
     */
    public function findByProductSku(string $sku): array;
}