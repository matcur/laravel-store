<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;
use App\Store\Cart\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = Cart::makeFromRequest($request);
        $order = Order::createFromCart($cart);

        return response()->json($order);
    }
}
