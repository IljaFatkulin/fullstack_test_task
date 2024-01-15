<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class AttributeValue extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $code
     * @param string|null $displayValue
     * @param string|null $value
     */
    public function __construct(
        private ?int $id = null,
        private ?string $code = null,
        private ?string $displayValue = null,
        private ?string $value = null
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getDisplayValue(): ?string
    {
        return $this->displayValue;
    }

    /**
     * @param string|null $displayValue
     */
    public function setDisplayValue(?string $displayValue): void
    {
        $this->displayValue = $displayValue;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'display_value' => $this->displayValue,
            'value' => $this->value
        ];
    }
}