<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Attribute;
use App\Model\AttributeType;
use App\Model\AttributeValue;
use App\Model\ProductAttributeValue;
use App\Repository\ProductAttributeValueRepository;
use App\Repository\ProductRepository;

class ProductAttributeValueRepositoryImpl extends AbstractRepository implements ProductAttributeValueRepository
{
    /**
     * @param string $sku
     * @return ProductAttributeValue[]
     */
    public function findByProductSku(string $sku): array
    {
        $stmt = $this->connection->prepare("
            SELECT 
                a.name, a.code AS attribute_code, t.type, av.code AS attribute_value_code, av.display_value, av.value
            FROM products_attributes_values pav
            JOIN products p 
                ON pav.product_id = p.id
            JOIN attributes a 
                ON pav.attribute_id = a.id
            JOIN attributes_types t 
                ON a.type_id = t.id
            JOIN attributes_values av 
                ON pav.attribute_value_id = av.id
            WHERE p.sku = ?
        ");
        $stmt->bind_param("s", $sku);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $productAttributeValues = [];
        foreach ($result as $data) {
            $productAttributeValues[] = $this->convertDataToObject($data);
        }
        return $productAttributeValues;
    }

    /**
     * @param $data
     * @return ProductAttributeValue
     */
    protected function convertDataToObject($data): ProductAttributeValue
    {
        $type = new AttributeType(null, $data['type']);
        $attribute = new Attribute(null, $data['attribute_code'], $type, $data['name']);
        $attributeValue = new AttributeValue(null, $data['attribute_value_code'], $data['display_value'], $data['value']);
        return new ProductAttributeValue(null, null, $attribute, $attributeValue);
    }
}