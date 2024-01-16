<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Brand;
use App\Model\Category\Subcategory;
use App\Model\Currency;
use App\Model\Price;
use App\Model\Product;
use App\Repository\ProductRepository;
use PDO;

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
            JOIN brands b 
            ON b.id = p.brand_id
        ");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
            JOIN brands b 
            ON b.id = p.brand_id
            WHERE p.name = :name
        ");
//        $stmt->bind_param("s", $name);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
//        $result = $stmt->get_result()->fetch_assoc();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return null;
        }

        return $this->convertDataToObject($result);
    }

    /**
     * @param string[] $skuList
     * @return Product[]
     */
    public function findBySkuArray(array $skuList): array
    {
//        $skus = 'huarache-x-stussy-le,jacket-canada-goosee';
//        $skuArray = explode(',', $skus);
//        var_dump($skuList);
//        var_dump($skuArray);
////        die;
        $placeholders = implode(',', array_fill(0, count($skuList), '?'));
        $stmt = $this->connection->prepare("
            SELECT p.*, s.name as subcategory, b.name as brand
            FROM products p 
            JOIN subcategories s
            ON s.id = p.subcategory_id
            JOIN brands b 
            ON b.id = p.brand_id
            WHERE p.sku IN ($placeholders)
        ");
        $stmt->execute($skuList);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($result as $product) {
            $products[] = $this->convertDataToObject($product);
        }
        return $products;
    }

    protected function convertDataToObject($data): Product
    {
        $subcategory = new Subcategory((int)$data['subcategory_id'], $data['subcategory']);
        $brand = new Brand((int)$data['brand_id'], $data['brand']);

        return new Product((int)$data['id'], $data['sku'], $data['name'], (bool)$data['in_stock'], $data['description'], $subcategory, $brand);
    }
}