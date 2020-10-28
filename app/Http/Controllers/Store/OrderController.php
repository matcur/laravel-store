<?php

namespace App\Http\Controllers\Store;

use App\DisposableUrl\DisposableUrl;
use App\Models\Order;
use App\Store\Cart\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('disposable-url:order')->only('pay');
    }

    public function create(Request $request)
    {
        Cart::makeFromJson($request->json_cart);

        $disposableUrl = DisposableUrl::make();
        DisposableUrl::putInSession('order', $disposableUrl);

        return redirect()
            ->route('store.order.pay', [
                'disposable_url' => $disposableUrl,
            ]);
    }

    /**
     * Создает неоплаченный заказ
     *
     * @param Cart $cart
     * @return RedirectResponse
     */
    public function pay(Cart $cart)
    {
        $order = Order::createFromCart($cart);

        return redirect()->away('some-pay-path');
    }
}
