<?php
declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class ProductOutOfStockException extends Exception
{
    /**
     * @param string $productSku
     */
    public function __construct(string $productSku = "")
    {
        $message = "Product {$productSku} out of stock";
        parent::__construct($message);
    }
}