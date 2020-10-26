<?php


namespace App\Store\Contracts\Cart;


interface BuyableSet
{
    public function buyableId();

    public function totalPrice();
}
