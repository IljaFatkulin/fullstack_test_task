<?php
declare(strict_types=1);

namespace App\Schema\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Order',
            'fields' => [
                'id' => Type::int(),
                'customer_email' => Type::string(),
                'products' => Type::listOf(new ObjectType([
                    'name' => 'Product',
                    'fields' => [
                        'product_id' => Type::string(),
                        'quantity' => Type::int()
                    ]
                ])),
            ]
        ]);
    }
}