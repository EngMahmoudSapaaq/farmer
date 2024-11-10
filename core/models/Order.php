<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;

class Order extends BaseModel {

    protected static $table = 'orders';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public function getUser(): User {
        $this->user = User::query()->find($this->user_id);
        return $this->user;
    }

    public function getProducts() {
        /**
         * @var ProductOrder[]
         */
        $productOrders = ProductOrder::query()->where("`order_id`={$this->id}")->all();
        $products = [];
        foreach ($productOrders as $po) {
            $products[] = $po->getProduct();
        }
        /**
         * @var Product[]
         */
        $this->products = $products;
        return $this->products;
    }

    public function calcTotal() {
        $this->total = 0;
        foreach (($this->products ?? []) as $product) {
            $this->total += ($product->ordered_qty * $product->price);
        }
        return $this->total;
    }

}
