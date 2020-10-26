<?php


namespace App\Store\Cart;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class ProductsSet
{
    public Product $product;
    public int $count;

    public function __construct(Product $product, int $count = 1)
    {
        if (!self::isValidProductsCount($count))
            self::throwInvalidCountException($count);

        $this->product = $product;
        $this->count = $count;
    }

    public function getProductId()
    {
        return $this->product->id;
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

    public function growCount(int $count)
    {
        if (!self::isValidProductsCount($count))
            self::throwInvalidCountException($count);

        $this->count += $count;
    }

    public static function isValidProductsCount($count)
    {
        return is_int($count) && $count > 0;
    }

    public static function throwInvalidCountException($count)
    {
        throw new InvalidParameterException("\$count must be more than 0 and be int, $count is given");
    }
}
