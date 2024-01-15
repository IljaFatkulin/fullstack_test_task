<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class ProductImage extends AbstractModel
{
    /**
     * @param int|null $id
     * @param Product|null $product
     * @param string|null $imageUrl
     */
    public function __construct(
        private ?int $id = null,
        private ?Product $product = null,
        private ?string $imageUrl = null
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
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
//            'product' => $this->product,
            'image_url' => $this->imageUrl
        ];
    }
}