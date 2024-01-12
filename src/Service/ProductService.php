<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Product;

interface ProductService
{
    /**
     * @return Product[]
     */
    public function findAll(): array;

    /**
     * @param string $name
     * @return Product|null
     */
    public function findByName(string $name): ?Product;
}