<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Attribute;

interface AttributeRepository
{

    /**
     * @param string $code
     * @return Attribute|null
     */
    public function findAttributeCode(string $code): ?Attribute;
}