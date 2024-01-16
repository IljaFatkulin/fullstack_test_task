<?php
declare(strict_types=1);

namespace App\Core;

abstract class AbstractModel implements \JsonSerializable
{
    /**
     * @return int|null
     */
    abstract public function getId(): ?int;

    /**
     * @param int $id
     * @return void
     */
    abstract public function setId(int $id): void;
}