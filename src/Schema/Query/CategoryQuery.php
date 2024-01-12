<?php
declare(strict_types=1);

namespace App\Schema\Query;

use App\Resolver\CategoryResolver;
use App\Schema\Type\CategoryType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryQuery extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
//            'name' => 'Query',
//            'fields' => [
//                'categories' => [
                    'type' => Type::listOf(new CategoryType()),
                    'args' => [
                        'name' => Type::string(),
                    ],
                    'resolve' => [new CategoryResolver(), 'resolve']
//                ]
//            ]x
        ]);
    }
}