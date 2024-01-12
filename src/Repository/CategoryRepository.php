<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Category\Category;

interface CategoryRepository
{
    /**
     * @return Category[]
     */
    public function findAll(): array;

    /**
     * @param string $name
     * @return Category|null
     */
    public function findByName(string $name): ?Category;
}