<?php
declare(strict_types=1);

namespace App\Schema\Query;

use App\Resolver\ProductResolver;
use App\Schema\Type\ProductType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductQuery extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'type' => Type::listOf(new ProductType()),
            'args' => [
                'id' => Type::string(),
                'categoryName' => Type::string(),
            ],
            'resolve' => [new ProductResolver(), 'resolve'],
        ]);
    }
}