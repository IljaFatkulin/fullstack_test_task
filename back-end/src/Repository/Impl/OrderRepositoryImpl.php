<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Product;
use App\Repository\OrderRepository;
use DateTime;
use Exception;
use PDO;
use RuntimeException;

class OrderRepositoryImpl extends AbstractRepository implements OrderRepository
{
    /**
     * @param string $customerEmail
     * @param array $products
     * @return string
     */
    public function saveOrder(string $customerEmail, array $products): string
    {
        try {
            $this->connection->beginTransaction();

            $orderId = $this->createOrder($customerEmail);

            foreach ($products as $product) {
                $this->createOrderProduct($product['id'], $product['quantity'], $orderId);
            }

            $this->connection->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw new RuntimeException('Transaction failed');
        }
    }

    /**
     * @param string $customerEmail
     * @return string
     */
    private function createOrder(string $customerEmail): string
    {
        $date = (new DateTime())->format("Y-m-d H:i:s");
        $stmt = $this->connection->prepare("
                INSERT INTO orders(customer_email, date) VALUES (:customer_email, :date)
            ");
        $stmt->execute([':customer_email' => $customerEmail, ':date' => $date]);

        return $this->connection->lastInsertId();
    }

    /**
     * @param int $productId
     * @param int $quantity
     * @param string $orderId
     * @return void
     */
    private function createOrderProduct(int $productId, int $quantity, string $orderId): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO orders_products(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)
        ");
        $stmt->execute([':order_id' => $orderId, ':product_id' => $productId, ':quantity' => $quantity]);
    }

    protected function convertDataToObject($data)
    {
        // TODO: Implement convertDataToObject() method.
    }
}