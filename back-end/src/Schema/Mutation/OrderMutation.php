<?php
declare(strict_types=1);

namespace App\Schema\Mutation;

use App\Resolver\OrderResolver;
use App\Schema\Type\CreateOrderResponseType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderMutation extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'type' => new CreateOrderResponseType(),
            'args' => [
                'customer_email' => Type::nonNull(Type::string()),
                'products' => Type::nonNull(Type::listOf(new InputObjectType([
                    'name' => 'Product',
                    'fields' => [
                        'product_id' => Type::nonNull(Type::string()),
                        'quantity' => Type::nonNull(Type::int()),
                        'attributes' => Type::nonNull(Type::listOf(new InputObjectType([
                            'name' => 'ProductAttribute',
                            'fields' => [
                                'attribute_code' => Type::nonNull(Type::string()),
                                'value_code' => Type::nonNull(Type::string()),
                            ],
                        ]))),
                    ]
                ]))),
            ],
            'resolve' => [new OrderResolver(), 'resolve']
        ]);
    }
}