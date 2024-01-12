<?php
declare(strict_types=1);

namespace App\Model\Category;

use App\Core\AbstractModel;

class Category extends AbstractModel
{
    /**
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(
        protected ?int $id = null,
        protected ?string $name = null,
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
            'name' => $this->name
        ];
    }
}