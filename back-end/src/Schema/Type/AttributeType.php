<?php
declare(strict_types=1);

namespace App\Schema\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Attribute',
            'fields' => [
                'id' => Type::string(),
                'items' => Type::listOf(new ObjectType([
                    'name' => 'Item',
                    'fields' => [
                        'displayValue' => Type::string(),
                        'value' => Type::string(),
                        'id' => Type::string()
                    ],
                ])),
                'name' => Type::string(),
                'type' => Type::string()
            ]
        ]);
    }
}