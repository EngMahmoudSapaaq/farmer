<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\Helpers\Session;

class Cart extends BaseModel {

    protected array $products = [];

    public function __construct() {
        $this->createIfNotExists();
    }

    private function createIfNotExists() {
        if (!Session::has('cart.products'))
            Session::set('cart.products', serialize([]));
    }

    public function has($id): bool {
        $res = $this->all()[$id] ?? false;
        return $res === false ? false : true;
    }

    public function all() {
        return unserialize(Session::get('cart.products'));
    }

    public function add($product) {
        $this->products = unserialize(Session::get('cart.products'));
        $this->products[$product->id] = $product;
        Session::set('cart.products', serialize($this->products));
    }

    public function remove($id) {
        $this->products = unserialize(Session::get('cart.products'));
        unset($this->products[$id]);
        Session::set('cart.products', serialize($this->products));
    }

    public function clear() {
        Session::unset('cart.products');
    }

}
