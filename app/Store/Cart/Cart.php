<?php


namespace App\Store\Cart;


use App\Models\Product;
use App\Store\Contracts\Cart\BuyableSet;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

    public static function makeFromRequest(Request $request)
    {
        $cart = app(Cart::class);
        $productsRequest = collect($request['products']);

        $ids = $productsRequest->pluck('id');
        $counts = $productsRequest->pluck('count');
        $products = Product::find($ids);
        for ($i = 0; $i < $products->count(); $i++) {
            $productsSet = new ProductsSet($products[$i], $counts[$i]);
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
            /** @var BuyableSet $item */
            $totalPrice += $item->totalPrice();
        }

        return $totalPrice;
    }

    public function add(BuyableSet $set)
    {
        $oldSet = $this->content->get($set->buyableId());
        if (!is_null($oldSet))
            $set->count += $oldSet->count;

        $this->content->put($set->buyableId(), $set);
        $this->session->put($this->id, $this->content);

        return $this;
    }

    public function get($buyableId)
    {
        /** @var Collection $content */
        $content = $this->session->get($this->id);

        return $content->get($buyableId);
    }

    public function remove($buyableId)
    {
        /** @var Collection $content */
        $content = $this->session->get($this->id);

        return $content->forget($buyableId);
    }

    public function flush()
    {
        $this->session->put($this->id, new Collection());
    }
}
