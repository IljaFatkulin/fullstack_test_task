<?php
declare(strict_types=1);

use App\Schema\Mutation\OrderMutation;
use App\Schema\RootMutation;
use App\Schema\RootQuery;
use GraphQL\Type\Schema;

$schema = new Schema([
    'query' => new RootQuery(),
    'mutation' => new RootMutation(),
]);