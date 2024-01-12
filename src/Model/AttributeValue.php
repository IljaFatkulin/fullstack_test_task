<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class AttributeValue extends AbstractModel
{
    /**
     * @param int|null $id
     * @param Attribute|null $attribute
     * @param Product|null $product
     * @param string|null $displayValue
     * @param string|null $value
     */
    public function __construct(
        private ?int $id = null,
        private ?Attribute $attribute = null,
        private ?Product $product = null,
        private ?string $displayValue = null,
        private ?string $value = null
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
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return string|null
     */
    public function getDisplayValue(): ?string
    {
        return $this->displayValue;
    }

    /**
     * @param string|null $displayValue
     */
    public function setDisplayValue(?string $displayValue): void
    {
        $this->displayValue = $displayValue;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'attribute' => $this->attribute,
            'display_value' => $this->displayValue,
            'value' => $this->value
        ];
    }
}