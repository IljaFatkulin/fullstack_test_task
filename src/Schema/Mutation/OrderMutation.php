<?php
declare(strict_types=1);

namespace App\Schema\Mutation;

use App\Resolver\OrderResolver;
use App\Schema\Type\OrderType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderMutation extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => new OrderType(),
                    'args' => [
                        'customer_email' => Type::nonNull(Type::string()),
                        'products' => Type::nonNull(Type::listOf(new InputObjectType([
                            'name' => 'Product',
                            'fields' => [
                                'product_id' => Type::nonNull(Type::string()),
                                'quantity' => Type::nonNull(Type::int())
                            ]
                        ]))),
                    ],
                    'resolve' => [new OrderResolver(), 'resolve']
                ]
            ]
        ]);
    }
}