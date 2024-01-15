<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Product;
use App\Model\ProductImage;
use App\Repository\GalleryRepository;

class GalleryRepositoryImpl extends AbstractRepository implements GalleryRepository
{
    /**
     * @return ProductImage[]
     */
    public function findAll(): array
    {
        $stmt = $this->connection->prepare("
            SELECT *
            FROM products_gallery
        ");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $gallery = [];
        foreach ($result as $productImage) {
            $gallery[] = $this->convertDataToObject($productImage);
        }

        return $gallery;
    }

    /**
     * @param string $sku
     * @return ProductImage[]
     */
    public function findByProductSku(string $sku): array
    {
        $stmt = $this->connection->prepare("
            SELECT g.*
            FROM products_gallery g
            JOIN products p 
                ON g.product_id = p.id
            WHERE p.sku = ?
        ");
        $stmt->bind_param("s", $sku);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $gallery = [];
        foreach ($result as $productImage) {
            $gallery[] = $this->convertDataToObject($productImage);
        }

        return $gallery;
    }

    protected function convertDataToObject($data): ProductImage
    {
        $product = new Product($data['product_id']);
        return new ProductImage($data['id'], $product, $data['image_url']);
    }
}