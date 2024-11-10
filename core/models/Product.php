<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;

class Product extends BaseModel {

    protected static $table = 'products';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public static function getFertilizers() {
        return self::query()->where("`type` = 'fer'")->get();
    }

    public static function getVegetables() {
        return self::query()->where("`type` = 'veg'")->get();
    }

    public function getFarmer(): Farmer {
        return Farmer::query()->find($this->farmer_id);
    }

    public function getRating(): float {
        $product_orders = ProductOrder::query()
            ->where("`farmer_id` = {$this->id}")->all();
        $ids = "";
        foreach ($product_orders as $temp) {
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

}
