<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Store\Cart\ProductsSet;
use App\Store\Services\CartService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private Session $session;
    private CartService $cartService;

    public function __construct(Session $session, CartService $cartService)
    {
        $this->session = $session;
        $this->cartService = $cartService;
    }

    public function show()
    {
        $cart = $this->cartService->getCart();

        return view('store.cart.show', compact('cart'));
    }

    public function add(Request $request)
    {
        $productsSet = ProductsSet::makeFromRequest($request);

        $cart = $this->cartService->getCart();
        $cart->add($productsSet);

        $this->cartService->putInSession($cart);

        return response()->json($cart);
    }

    public function remove(Request $request)
    {
        $productsSet = ProductsSet::makeFromRequest($request);

        $cart = $this->cartService->getCart();
        $cart->remove($productsSet);

        $this->cartService->putInSession($cart);

        return response()->json($cart);
    }
}
