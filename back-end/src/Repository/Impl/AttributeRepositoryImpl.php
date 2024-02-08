<?php
declare(strict_types=1);

namespace App\Repository\Impl;

use App\Core\AbstractRepository;
use App\Model\Attribute;
use App\Repository\AttributeRepository;
use PDO;

class AttributeRepositoryImpl extends AbstractRepository implements AttributeRepository
{
    public function findAttributeCode(string $code): ?Attribute
    {
        $stmt = $this->connection->prepare("
            SELECT * FROM attributes WHERE code = :code
        ");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return null;
        }

        return $this->convertDataToObject($result);
    }

    protected function convertDataToObject($data)
    {
        return new Attribute($data['id'], $data['code'], null, $data['name']);
    }
}