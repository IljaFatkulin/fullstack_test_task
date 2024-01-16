<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Model\ProductImage;
use App\Repository\GalleryRepository;
use App\Repository\Impl\GalleryRepositoryImpl;
use App\Service\GalleryService;

class GalleryServiceImpl implements GalleryService
{
    private GalleryRepository $galleryRepository;

    public function __construct()
    {
        $this->galleryRepository = new GalleryRepositoryImpl();
    }

    /**
     * @return ProductImage[]
     */
    public function findAll(): array
    {
        return $this->galleryRepository->findAll();
    }

    /**
     * @param string $sku
     * @return array|ProductImage[]
     */
    public function findByProductSku(string $sku): array
    {
        return $this->galleryRepository->findByProductSku($sku);
    }
}