<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Attribute;
use App\Model\Product;
use App\Repository\AttributeRepository;
use App\Repository\OrderProductAttributeValueRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductAttributeValueRepository;
use DateTime;
use Exception;
use PDO;
use RuntimeException;

class OrderRepositoryImpl extends AbstractRepository implements OrderRepository
{
    private OrderProductAttributeValueRepository $orderProductAttributeValueRepository;
    private AttributeRepository $attributeRepository;
    private ProductAttributeValueRepository $productAttributeValueRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderProductAttributeValueRepository = new OrderProductAttributeValueRepositoryImpl();
        $this->attributeRepository = new AttributeRepositoryImpl();
        $this->productAttributeValueRepository = new ProductAttributeValueRepositoryImpl();
    }

    /**
     * @param string $customerEmail
     * @param array $products
     * @return string
     */
    public function saveOrder(string $customerEmail, array $products): string
    {
        try {
//            $this->connection->beginTransaction();

            $orderId = $this->createOrder($customerEmail);

            foreach ($products as $sku => $product) {
                $orderProductId = $this->createOrderProduct($product['id'], $product['quantity'], $orderId);
                $productAttributeValues = $this->productAttributeValueRepository->findByProductSku($sku);

                foreach ($product['attributes'] as $productAttribute) {
                    $matchingAttributeValue = null;

                    foreach ($productAttributeValues as $productAttributeValue) {
                        $attributeValue = $productAttributeValue->getAttributeValue();
                        if ($attributeValue->getCode() === $productAttribute['value_code']) {
                            $matchingAttributeValue = $attributeValue;
                            break;
                        }
                    }


                    if (!$matchingAttributeValue) {
                        continue;
                    }


                    $attribute = $this->attributeRepository->findAttributeCode($productAttribute['attribute_code']);
                    $this->orderProductAttributeValueRepository->saveOrderProductAttributeValue((int)$orderProductId, $attribute->getId(), $matchingAttributeValue->getId());
                }
            }

//            $this->connection->commit();
            return $orderId;
        } catch (Exception $e) {
//            $this->connection->rollBack();
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
     * @return string
     */
    private function createOrderProduct(int $productId, int $quantity, string $orderId): string
    {
        $stmt = $this->connection->prepare("
            INSERT INTO orders_products(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)
        ");
        $stmt->execute([':order_id' => $orderId, ':product_id' => $productId, ':quantity' => $quantity]);

        return $this->connection->lastInsertId();
    }

    protected function convertDataToObject($data)
    {
        // TODO: Implement convertDataToObject() method.
    }
}