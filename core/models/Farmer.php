<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;
use Core\Helpers\Interfaces\Authenticatable;

class Farmer extends BaseModel implements Authenticatable {
    use \Core\Helpers\Traits\Authenticatable;

    protected static $table = 'farmers';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public function getRating(): float {
        $farmer_orders = FarmerOrder::query()
            ->where("`farmer_id` = {$this->id}")->all();
        $ids = "";
        foreach ($farmer_orders as $temp) {
            $ids .= $temp->order_id . ',';
        }
        $ids = trim($ids, ',');
        $orders = Order::query()->whereIn('id', $ids)->get();
        $rating = 0;
        $count = 0;
        foreach ($orders as $order) {
            $count++;
            $rating += $order->rate;
        }
        return $count == 0 ? 0 : $rating / $count;
    }

    public static function getOrders($farmer_id) {
        $orders = FarmerOrder::query()->where("`farmer_id`=$farmer_id")->get();
        $orders_ids = array_column($orders, 'order_id');
        return Order::query()->whereIn('id', implode(',', $orders_ids))->get();
    }

}
