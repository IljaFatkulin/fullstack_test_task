<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class ProductAttributeValue extends AbstractModel
{
    /**
     * @param int|null $id
     * @param Product|null $product
     * @param Attribute|null $attribute
     * @param AttributeValue|null $attributeValue
     */
    public function __construct(
        private ?int $id = null,
        private ?Product $product = null,
        private ?Attribute $attribute = null,
        private ?AttributeValue $attributeValue = null
    ) {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return Attribute|null
     */
    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    /**
     * @param Attribute|null $attribute
     */
    public function setAttribute(?Attribute $attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return AttributeValue|null
     */
    public function getAttributeValue(): ?AttributeValue
    {
        return $this->attributeValue;
    }

    /**
     * @param AttributeValue|null $attributeValue
     */
    public function setAttributeValue(?AttributeValue $attributeValue): void
    {
        $this->attributeValue = $attributeValue;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'attribute' => $this->attribute,
            'attribute_value' => $this->attributeValue
        ];
    }
}