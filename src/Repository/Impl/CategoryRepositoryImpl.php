<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Category\Category;
use App\Repository\CategoryRepository;

class CategoryRepositoryImpl extends AbstractRepository implements CategoryRepository
{
    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        $stmt = $this->connection->prepare("
            SELECT id, name FROM root_categories
            UNION 
            SELECT id, name FROM subcategories
        ");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $categories = [];
        foreach ($result as $category) {
            $categories[] = $this->convertDataToObject($category);
        }

        return $categories;
    }

    /**
     * @param string $name
     * @return Category|null
     */
    public function findByName(string $name): ?Category
    {
        $stmt = $this->connection->prepare("
            SELECT id, name 
            FROM (
                SELECT id, name FROM root_categories
                UNION 
                SELECT id, name FROM subcategories
            ) AS categories
            WHERE name = ?
        ");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        if(!$result) {
            return null;
        }

        return $this->convertDataToObject($result);
    }

    protected function convertDataToObject($data): Category
    {
        return new Category($data['id'], $data['name']);
    }
}