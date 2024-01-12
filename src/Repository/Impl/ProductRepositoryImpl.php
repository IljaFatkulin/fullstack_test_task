<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Brand;
use App\Model\Category\Subcategory;
use App\Model\Product;
use App\Repository\ProductRepository;

class ProductRepositoryImpl extends AbstractRepository implements ProductRepository
{
    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        $stmt = $this->connection->prepare("
            SELECT p.*, s.name as subcategory, b.name as brand
            FROM products p 
            JOIN subcategories s
            ON s.id = p.subcategory_id
            JOIN products_brands b 
            ON b.id = p.brand_id
        ");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = [];
        foreach ($result as $product) {
            $products[] = $this->convertDataToObject($product);
        }
        return $products;
    }

    /**
     * @param string $name
     * @return Product|null
     */
    public function findByName(string $name): ?Product
    {
        $stmt = $this->connection->prepare("
            SELECT p.*, s.name as subcategory, b.name as brand
            FROM products p 
            JOIN subcategories s
            ON s.id = p.subcategory_id
            JOIN products_brands b 
            ON b.id = p.brand_id
            WHERE p.name = ?
        ");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if(!$result) {
            return null;
        }

        return $this->convertDataToObject($result);
    }

    private function convertDataToObject($data): Product
    {
        // TODO: Add Gallery and Prices
        $subcategory = new Subcategory((int)$data['subcategory_id'], $data['subcategory']);
        $brand = new Brand((int)$data['brand_id'], $data['brand']);

        return new Product((int)$data['id'], $data['sku'], $data['name'], (bool)$data['in_stock'], $data['description'], $subcategory, $brand);
    }
}