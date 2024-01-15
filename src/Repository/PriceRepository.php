<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Price;

interface PriceRepository
{
    /**
     * @param string $sku
     * @return Price[]
     */
    public function findByProductSku(string $sku): array;
}