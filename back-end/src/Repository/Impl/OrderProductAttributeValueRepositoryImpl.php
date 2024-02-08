<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Repository\OrderProductAttributeValueRepository;

class OrderProductAttributeValueRepositoryImpl extends AbstractRepository implements OrderProductAttributeValueRepository
{

    public function saveOrderProductAttributeValue(int $orderProductId, int $attributeId, int $attributeValueId): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO orders_products_attributes_values(order_product_id, attribute_id, attribute_value_id) VALUES (:orderProductId, :attributeId, :attributeValueId)
        ");

        $stmt->execute([':orderProductId' => $orderProductId, ':attributeId' => $attributeId, ':attributeValueId' => $attributeValueId]);
    }

    protected function convertDataToObject($data)
    {
        // TODO: Implement convertDataToObject() method.
    }
}