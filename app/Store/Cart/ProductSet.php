<?php


namespace App\Store\Cart;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductSet
{
    public int $count;
    public int $totalPrice;
    public Product $product;

    public function __construct(Product $product, int $count = 1)
    {
        $this->product = $product;
        $this->count = $count;
        $this->totalPrice = $this->totalPrice();
    }

    public function getTotalPrice()
    {
        return $this->count * $this->product->price;
    }

    public function getCurrencySymbol()
    {
        return $this->product->getCurrencySymbol();
    }

    public function getTotalPriceWithSymbol()
    {
        return $this->getTotalPrice() . ' ' . $this->getCurrencySymbol();
    }

    public static function makeFromRequest(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        return new static($product, $request->count);
    }

    public function buyableId()
    {
        return $this->product->id;
    }

    public function totalPrice()
    {
        return $this->product->price * $this->count;
    }
}
