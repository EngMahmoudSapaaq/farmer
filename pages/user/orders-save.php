<?php

    require_once __DIR__ . "/../../vendor/autoload.php";

    use Core\Helpers\Auth;
    use Core\Helpers\Redirect;
    use Core\Helpers\Request;
    use Core\Helpers\Session;
    use Core\Models\FarmerOrder;
    use Core\Models\Order;
    use Core\Models\Product;
    use Core\Models\ProductOrder;

    session_start();

    Redirect::ifNotUser();
    
    try {

        $products = Request::get('products');
        $payment_type = Request::get('payment_type');
        $user_id = Auth::user()->id;
        $now = date('Y-m-d H:i:s');
        
        $products_models = [];
        foreach ($products as $product_id => $quantity) {
            $product = Product::query()->find($product_id);
            $products_models[$product->id] = $product;
            if ($product->quantity >= $quantity) {
                $new_quantity = $product->quantity - $quantity;
                Product::query()->where("`id`=$product_id")->update("`quantity`=$new_quantity");
            } else {
                Session::set('error', 'Quantity not enough');
                header('Location: purchases.php');
                exit;
            }
        }

        $order_id = Order::query()->insert("
            `payment_type`='$payment_type',
            `user_id`=$user_id,
            `created_at`='$now'
        ");

        $farmers_ids = [];
        foreach ($products as $product_id => $quantity) {
            $id = $products_models[$product_id]->farmer_id;
            $farmers_ids[$id] = $id;
            ProductOrder::query()->insert("
                `order_id`=$order_id,
                `product_id`=$product_id,
                `quantity`=$quantity,
                `created_at`='$now'
            ");
        }

        foreach ($farmers_ids as $farmer_id) {
            FarmerOrder::query()->insert("
                `order_id`=$order_id,
                `farmer_id`=$farmer_id,
                `created_at`='$now'
            ");
        }

        Session::unset('cart.products');
        
        Session::set('done', 'Order has been send successfully');
        header('Location: orders.php');
        exit;

    } catch (\Exception $e) {
        // throw $e;
        Session::set('error', 'Error while saving order. try again later');
        header('Location: orders.php');
        exit;
    }
