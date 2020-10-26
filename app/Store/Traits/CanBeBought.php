<?php


namespace App\Store\Traits;


trait CanBeBought
{
    public function getBuyableId()
    {
        return static::class . $this->id;
    }

    public function getBuyablePrice()
    {
        return $this->price;
    }

    public function getCurrencySymbol()
    {
        return $this->currency->symbol;
    }
}
