<?php
declare(strict_types=1);

namespace App\Resolver;

use App\Service\Impl\PriceServiceImpl;
use App\Service\PriceService;
use GraphQL\Type\Definition\ObjectType;

class PriceResolver
{
    private PriceService $priceService;

    public function __construct()
    {
        $this->priceService = new PriceServiceImpl();
    }

    /**
     * @param $root
     * @return array
     */
    public function resolve($root): array
    {
        $productSku = $root['id'];

        $prices = $this->priceService->findByProductSku($productSku);

        $response = [];
        foreach ($prices as $price) {
            $currency = $price->getCurrency();
            $response[] = [
                'amount' => number_format($price->getAmount(),2),
                'currency' => [
                    'label' => $currency->getLabel(),
                    'symbol' => $currency->getSymbol()
                ]
            ];
        }
        return $response;
    }
}