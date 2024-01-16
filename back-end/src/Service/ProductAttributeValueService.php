<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ProductAttributeValue;

interface ProductAttributeValueService
{
    /**
     * @param string $sku
     * @return ProductAttributeValue[]
     */
    public function findByProductSku(string $sku): array;
}