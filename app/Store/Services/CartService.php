<?php


namespace App\Store\Services;


use App\Store\Cart\Cart;
use Illuminate\Contracts\Session\Session;

class CartService
{
    private Session $session;
    private string $cartSessionId;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->cartSessionId = 'cart';
    }

    public function getCart(): Cart
    {
        if ($this->session->has($this->cartSessionId))
            return $this->getCartFromSession();

        return new Cart();
    }

    public function getCartFromSession(): Cart
    {
        return $this->session->get($this->cartSessionId);
    }

    public function putInSession(Cart $cart)
    {
        $this->session->put($this->cartSessionId, $cart);
    }
}
