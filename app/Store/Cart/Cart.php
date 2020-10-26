<?php


namespace App\Store\Cart;


class Cart
{
    /** @var ProductsSet[] */
    public array $items = [];

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    public function add(ProductsSet $productsSet)
    {
        $productId = $productsSet->getProductId();
        if (isset($this->items[$productId])) {
            $this->items[$productId]->growCount($productsSet->count);
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
            throw new \Exception("Product $productId doesn't found.");
        }
    }
}
