<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\ProductImage;

interface GalleryRepository
{
    /**
     * @return ProductImage[]
     */
    public function findAll(): array;

    /**
     * @param string $sku
     * @return ProductImage[]
     */
    public function findByProductSku(string $sku): array;
}