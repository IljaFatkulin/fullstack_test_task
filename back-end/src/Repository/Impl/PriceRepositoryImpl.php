<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Currency;
use App\Model\Price;
use App\Repository\PriceRepository;
use PDO;

class PriceRepositoryImpl extends AbstractRepository implements PriceRepository
{
    /**
     * @param string $sku
     * @return Price[]
     */
    public function findByProductSku(string $sku): array
    {
        $stmt = $this->connection->prepare("
            SELECT pp.amount, pp.id AS price_id, pc.id AS currency_id, pc.label, pc.symbol
            FROM products_prices pp
            JOIN products p 
                ON pp.product_id = p.id
            JOIN prices_currencies pc 
                ON pp.currency_id = pc.id
            WHERE p.sku = :sku
        ");
//        $stmt->bind_param("s", $sku);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->execute();
//        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $prices = [];
        foreach ($result as $price) {
            $prices[] = $this->convertDataToObject($price);
        }
        return $prices;
    }

    /**
     * @param $data
     * @return Price
     */
    protected function convertDataToObject($data): Price
    {
        $currency = new Currency($data['currency_id'], $data['label'], $data['symbol']);
        return new Price($data['price_id'], round((float)$data['amount'], 2), $currency);
    }

}