<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;

class FarmerOrder extends BaseModel {

    protected static $table = 'farmer_orders';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public function getOrder() {
        return Order::query()->find($this->order_id);
    }

    public function getFarmer() {
        return Farmer::query()->find($this->farmer_id);
    }

}
