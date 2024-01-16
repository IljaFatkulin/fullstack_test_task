<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\GalleryService;
use App\Service\Impl\GalleryServiceImpl;

class GalleryResolver
{
    private GalleryService $galleryService;

    public function __construct()
    {
        $this->galleryService = new GalleryServiceImpl();
    }

    /**
     * @param $root
     * @return array
     */
    public function resolve($root): array
    {
        $productSku = $root['id'];

        $gallery = $this->galleryService->findByProductSku($productSku);

        $response = [];
        foreach ($gallery as $image) {
            $response[] = $image->getImageUrl();
        }
        return $response;
    }
}