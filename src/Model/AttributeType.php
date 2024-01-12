<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class AttributeType extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $type
     */
    public function __construct(
        private ?int $id = null,
        private ?string $type = null
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'type' => $this->type
        ];
    }
}