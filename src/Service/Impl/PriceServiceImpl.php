<?php
declare(strict_types=1);

namespace App\Service\Impl;

use App\Model\Price;
use App\Repository\Impl\PriceRepositoryImpl;
use App\Repository\PriceRepository;
use App\Service\PriceService;

class PriceServiceImpl implements PriceService
{
    private PriceRepository $priceRepository;

    public function __construct()
    {
        $this->priceRepository = new PriceRepositoryImpl();
    }

    /**
     * @param string $sku
     * @return Price[]
     */
    public function findByProductSku(string $sku): array
    {
        return $this->priceRepository->findByProductSku($sku);
    }
}