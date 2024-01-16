<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\Impl\ProductAttributeValueServiceImpl;
use App\Service\ProductAttributeValueService;

class AttributeResolver
{
    private ProductAttributeValueService $productAttributeValueService;

    public function __construct()
    {
        $this->productAttributeValueService = new ProductAttributeValueServiceImpl();
    }

    /**
     * @param $root
     * @return array
     */
    public function resolve($root): array
    {
        $productSku = $root['id'];

        $attributes = $this->productAttributeValueService->findByProductSku($productSku);

        $response = [];
        foreach ($attributes as $productAttributeValue) {
            $attribute = $productAttributeValue->getAttribute();
            $attributeValue = $productAttributeValue->getAttributeValue();
            $attributeType = $attribute->getType();

            if(!isset($response[$attribute->getCode()])) {
                $response[$attribute->getCode()] = [
                    'id' => $attribute->getCode(),
                    'items' => [],
                    'name' => $attribute->getName(),
                    'type' => $attributeType->getType()
                ];
            }

            $response[$attribute->getCode()]['items'][] = [
                'displayValue' => $attributeValue->getDisplayValue(),
                'value' => $attributeValue->getValue(),
                'id' => $attributeValue->getCode(),
            ];
        }
        return $response;
    }
}