<?php
declare(strict_types=1);

namespace App\Repository;

interface OrderProductAttributeValueRepository
{
    /**
     * @param int $orderProductId
     * @param int $attributeId
     * @param int $attributeValueId
     * @return void
     */
    public function saveOrderProductAttributeValue(int $orderProductId, int $attributeId, int $attributeValueId): void;
}