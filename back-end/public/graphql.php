<?php
declare(strict_types=1);

use GraphQL\GraphQL;

include '../src/Schema/schema.php';

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

$result = GraphQL::executeQuery($schema, $input['query'], null, null,null);
echo json_encode($result->toArray());