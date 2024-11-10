<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;

class ProductOrder extends BaseModel {

    protected static $table = 'order_products';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public function getOrder() {
        return Order::query()->find($this->order_id);
    }

    public function getProduct() {
        $product = Product::query()->find($this->product_id);
        $product->ordered_qty = $this->quantity;
        return $product;
    }

}
