<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class Price extends AbstractModel
{
    /**
     * @param int|null $id
     * @param float|null $amount
     * @param Currency|null $currency
     * @param Product|null $product
     */
    public function __construct(
        private ?int $id = null,
        private ?float $amount = null,
        private ?Currency $currency = null,
        private ?Product $product = null
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
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return round($this->amount, 2);
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Currency|null
     */
    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency|null $currency
     */
    public function setCurrency(?Currency $currency): void
    {
        $this->currency = $currency;
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

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'currency' => $this->currency
        ];
    }
}