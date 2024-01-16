<?php
declare(strict_types=1);

namespace App\Schema;

use App\Schema\Mutation\OrderMutation;
use GraphQL\Type\Definition\ObjectType;

class RootMutation extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => (new OrderMutation())->config,
            ]
        ]);
    }
}