<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class Currency extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $label
     * @param string|null $symbol
     */
    public function __construct(
        private ?int $id = null,
        private ?string $label = null,
        private ?string $symbol = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    /**
     * @param string|null $symbol
     */
    public function setSymbol(?string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'symbol' => $this->symbol
        ];
    }
}