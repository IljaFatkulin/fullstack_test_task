<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;
use App\Model\Category\Subcategory;

class Product extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $sku
     * @param string|null $name
     * @param bool $inStock
     * @param string|null $description
     * @param Subcategory|null $subcategory
     * @param Brand|null $brand
     * @param ProductImage[] $gallery
     * @param Price[] $prices
     */
    public function __construct(
        private ?int $id = null,
        private ?string $sku = null,
        private ?string $name = null,
        private bool $inStock = false,
        private ?string $description = null,
        private ?Subcategory $subcategory = null,
        private ?Brand $brand = null,
        private array $gallery = [],
        private array $prices = []
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
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     */
    public function setSku(?string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->inStock;
    }

    /**
     * @param bool $inStock
     */
    public function setInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Subcategory|null
     */
    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    /**
     * @param Subcategory|null $subcategory
     */
    public function setSubcategory(?Subcategory $subcategory): void
    {
        $this->subcategory = $subcategory;
    }

    /**
     * @return Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand|null $brand
     */
    public function setBrand(?Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return ProductImage[]
     */
    public function getGallery(): array
    {
        return $this->gallery;
    }

    /**
     * @param ProductImage[] $gallery
     */
    public function setGallery(array $gallery): void
    {
        $this->gallery = $gallery;
    }

    public function addToGallery(ProductImage $image): void
    {
        $this->gallery[] = $image;
    }

    /**
     * @return Price[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param Price[] $prices
     */
    public function setPrices(array $prices): void
    {
        $this->prices = $prices;
    }

    /**
     * @param Price $price
     * @return void
     */
    public function addPrice(Price $price): void
    {
        $this->prices[] = $price;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'in_stock' => $this->inStock,
            'description' => $this->description,
            'subcategory' => $this->subcategory,
            'brand' => $this->brand
        ];
    }
}