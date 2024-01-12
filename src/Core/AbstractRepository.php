<?php
declare(strict_types=1);

namespace App\Core;

use App\Config\DB;
use mysqli;

abstract class AbstractRepository
{
    protected ?mysqli $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }
}