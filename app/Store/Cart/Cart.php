<?php


namespace App\Store\Cart;


use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Cart
{
    /** @var Collection $content */
    public Collection $content;
    public Session $session;
    private string $id;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->id = 'cart';
        $this->content = $this->session->get($this->id) ?? new Collection;
    }

    /**
     * $json = '[id:]'
     *
     * @param string $json
     * @return Cart
     */
    public static function makeFromJson(string $json)
    {
        /** @var Cart $cart */
        $cart = app(Cart::class);
        $productsData = collect(json_decode($json));

        $ids = $productsData->pluck('id');
        $counts = $productsData->pluck('count');
        $products = Product::findOrFail($ids);
        for ($i = 0; $i < $products->count(); $i++) {
            $productsSet = new ProductSet($products[$i], $counts[$i]);
            $cart->add($productsSet);
        }

        return $cart;
    }

    /**
     * Todo! Если у наборов продуктов будут разные валюты,
     * то выдаст неправильную цену
     */
    public function totalPrice()
    {
        $totalPrice = 0;
        foreach ($this->content as $item) {
            /** @var ProductSet $item */
            $totalPrice += $item->totalPrice();
        }

        return $totalPrice;
    }

    public function add(ProductSet $set)
    {
        $oldSet = $this->content->get($set->buyableId());
        if (!is_null($oldSet))
            $set->count += $oldSet->count;

        if ($set->count < 0) {
            throw new \Exception("Product count can't be less than 0, {$set->count} given");
        }

        if ($set->count == 0) {
            $this->remove($set->buyableId());
            return $this;
        }

        $this->content->put($set->buyableId(), $set);
        $this->session->put($this->id, $this->content);

        return $this;
    }

    public function get($buyableId): ?ProductSet
    {
        return $this->content->get($buyableId);
    }

    public function remove($buyableId)
    {
        return $this->content->forget($buyableId);
    }

    public function flush()
    {
        $this->session->put($this->id, new Collection());
    }

    public function productSetCount($buyableId)
    {
        $productSet = $this->content->get($buyableId);

        if (!is_null($productSet))
            return $productSet->count;

        return 0;
    }
}
