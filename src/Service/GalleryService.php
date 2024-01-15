<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ProductImage;

interface GalleryService
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