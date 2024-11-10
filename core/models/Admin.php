<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;
use Core\Helpers\Interfaces\Authenticatable;

class Admin extends BaseModel implements Authenticatable {
    use \Core\Helpers\Traits\Authenticatable;

    protected static $table = 'admins';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

}
