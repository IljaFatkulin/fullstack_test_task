<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Model\ProductAttributeValue;
use App\Repository\Impl\ProductAttributeValueRepositoryImpl;
use App\Repository\ProductAttributeValueRepository;
use App\Service\ProductAttributeValueService;

class ProductAttributeValueServiceImpl implements ProductAttributeValueService
{
    private ProductAttributeValueRepository $productAttributeValueRepository;

    public function __construct()
    {
        $this->productAttributeValueRepository = new ProductAttributeValueRepositoryImpl();
    }

    /**
     * @param string $sku
     * @return ProductAttributeValue[]
     */
    public function findByProductSku(string $sku): array
    {
        return $this->productAttributeValueRepository->findByProductSku($sku);
    }
}