<?php
declare(strict_types=1);

namespace App\Schema;

use App\Schema\Query\CategoryQuery;
use App\Schema\Query\ProductQuery;
use GraphQL\Type\Definition\ObjectType;

class RootQuery extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'categories' => (new CategoryQuery())->config,
                'products' => (new ProductQuery())->config,
            ]
        ]);
    }
}