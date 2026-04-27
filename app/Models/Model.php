<?php

namespace App\Models;

use App\DB;
use PDO;

class Model
{
    protected ?PDO $db = null;

    protected function db(): PDO
    {
        if ($this->db === null) {
            $db = new DB();
            $this->db = $db->getInstance();
        }
        return $this->db;
    }
}