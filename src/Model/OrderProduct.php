<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class OrderProduct extends AbstractModel
{
    /**
     * @param int|null $id
     * @param Order|null $order
     * @param Product|null $product
     * @param int|null $quantity
     * @param float|null $amount
     */
    public function __construct(
        private ?int $id = null,
        private ?Order $order = null,
        private ?Product $product = null,
        private ?int $quantity = null,
        private ?float $amount = null
    ) {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     */
    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }


    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
        ];
    }
}