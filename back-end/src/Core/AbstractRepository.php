<?php
declare(strict_types=1);

namespace App\Core;

use App\Config\DB;
use mysqli;
use PDO;

abstract class AbstractRepository
{
//    protected ?mysqli $connection;
    protected ?PDO $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }

    abstract protected function convertDataToObject($data);
}