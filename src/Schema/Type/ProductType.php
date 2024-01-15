<?php
declare(strict_types=1);

namespace App\Schema\Type;

use App\Resolver\AttributeResolver;
use App\Resolver\GalleryResolver;
use App\Resolver\PriceResolver;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'id' => Type::string(),
                'name' => Type::string(),
                'inStock' => Type::boolean(),
                'gallery' => [
                    'type' => Type::listOf(Type::string()),
                    'resolve' => [new GalleryResolver(), 'resolve']
                ],
                'description' => Type::string(),
                'category' => Type::string(),
                'attributes' => [
                    'type' => Type::listOf(new AttributeType()),
                    'resolve' => [new AttributeResolver(), 'resolve']
                ],
                'brand' => Type::string(),
                'prices' => [
                    'type' => Type::listOf(new PriceType()),
                    'resolve' => [new PriceResolver(), 'resolve']
                ],
            ]
        ]);
    }
}