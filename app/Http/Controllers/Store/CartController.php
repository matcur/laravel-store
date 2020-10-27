<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Store\Cart\Cart;
use App\Store\Cart\ProductSet;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function show(Cart $cart)
    {
        return view('store.cart.show', compact('cart'));
    }

    public function add(Request $request, Cart $cart)
    {
        $productsSet = ProductSet::makeFromRequest($request);
        $cart->add($productsSet);

        return response()->json($cart);
    }

    public function flush(Cart $cart)
    {
        $cart->flush();

        return response()->json($cart);
    }

    public function remove(Request $request, Cart $cart)
    {
        $productsSet = ProductSet::makeFromRequest($request);
        $cart->remove($productsSet->id);

        return response()->json($cart);
    }
}
