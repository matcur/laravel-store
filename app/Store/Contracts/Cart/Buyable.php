<?php


namespace App\Store\Contracts\Cart;


interface Buyable
{
    public function getBuyableId();

    public function getBuyablePrice();

    public function getCurrencySymbol();
}
