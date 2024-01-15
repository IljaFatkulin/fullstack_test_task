<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\AttributeValue;
use App\Model\ProductAttributeValue;

interface ProductAttributeValueRepository
{
    /**
     * @param string $sku
     * @return ProductAttributeValue[]
     */
    public function findByProductSku(string $sku): array;
}