<?php
declare(strict_types=1);

namespace App\Schema\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PriceType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Price',
            'fields' => [
                'amount' => Type::string(),
                'currency' => new ObjectType([
                    'name' => 'Currency',
                    'fields' => [
                       'label' => Type::string(),
                       'symbol' => Type::string()
                   ]
                ]),
            ]
        ]);
    }
}