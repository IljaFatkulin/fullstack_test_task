<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class Attribute extends AbstractModel
{
    /**
     * @param int|null $id
     * @param AttributeType|null $type
     * @param string|null $name
     */
    public function __construct(
        private ?int $id = null,
        private ?string $code = null,
        private ?AttributeType $type = null,
        private ?string $name = null
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
     * @return AttributeType|null
     */
    public function getType(): ?AttributeType
    {
        return $this->type;
    }

    /**
     * @param AttributeType|null $type
     */
    public function setType(?AttributeType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name
        ];
    }
}