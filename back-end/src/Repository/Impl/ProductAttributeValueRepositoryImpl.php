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
use PDO;

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
                a.id as attribute_id, a.name, a.code AS attribute_code, t.id as type_id, t.type, av.id as attribute_value_id, av.code AS attribute_value_code, av.display_value, av.value
            FROM products_attributes_values pav
            JOIN products p 
                ON pav.product_id = p.id
            JOIN attributes a 
                ON pav.attribute_id = a.id
            JOIN attributes_types t 
                ON a.type_id = t.id
            JOIN attributes_values av 
                ON pav.attribute_value_id = av.id
            WHERE p.sku = :sku
        ");
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
//        $stmt->bind_param("s", $sku);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
        $type = new AttributeType((int)$data['type_id'], $data['type']);
        $attribute = new Attribute((int)$data['attribute_id'], $data['attribute_code'], $type, $data['name']);
        $attributeValue = new AttributeValue((int)$data['attribute_value_id'], $data['attribute_value_code'], $data['display_value'], $data['value']);
        return new ProductAttributeValue(null, null, $attribute, $attributeValue);
    }
}