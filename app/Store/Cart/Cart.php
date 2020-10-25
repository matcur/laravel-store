<?php


namespace App\Store\Cart;


use Symfony\Component\Routing\Exception\InvalidParameterException;

class Cart
{
    /** @var ProductsSet[] */
    public array $items;

    public function add(ProductsSet $productsSet)
    {
        $productId = $productsSet->getProductId();
        if (isset($this->items[$productId])) {
            $this->items[$productId]->growCount($productsSet->getCount());
        } else {
            $this->items[$productId] = $productsSet;
        }

        return $this;
    }

    public function remove(ProductsSet $productsSet)
    {
        $productId = $productsSet->getProductId();
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        } else {
            throw new InvalidParameterException("Product $productId doesn't exists");
        }
    }
}
