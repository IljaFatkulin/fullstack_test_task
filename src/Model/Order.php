<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;
use DateTime;

class Order extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $customerEmail
     * @param float|null $totalAmount
     * @param DateTime|null $date
     */
    public function __construct(
        private ?int $id = null,
        private ?string $customerEmail = null,
        private ?float $totalAmount = null,
        private ?DateTime $date = null
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
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    /**
     * @param string|null $customerEmail
     */
    public function setCustomerEmail(?string $customerEmail): void
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @param float|null $totalAmount
     */
    public function setTotalAmount(?float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'customer_email' => $this->customerEmail,
            'total_amount' => $this->totalAmount,
            'date' => $this->date
        ];
    }
}