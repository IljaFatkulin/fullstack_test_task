<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Product;

interface ProductRepository
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

    /**
     * @param string[] $skuList
     * @return Product[]
     */
    public function findBySkuArray(array $skuList): array;
}