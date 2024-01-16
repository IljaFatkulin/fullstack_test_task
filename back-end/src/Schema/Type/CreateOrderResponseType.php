<?php
declare(strict_types=1);

namespace App\Schema\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CreateOrderResponseType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Order',
            'fields' => [
                'id' => Type::int(),
            ]
        ]);
    }
}