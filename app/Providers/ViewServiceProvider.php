<?php

namespace App\Providers;

use App\Store\Recommends\RecommendProduct;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    private array $needRecommendProducts = [
        'store.products.*',
        'store.cart.*',
        'store.home',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer($this->needRecommendProducts, function() {
            view()->share('recommendProducts', RecommendProduct::get(request()->ip(), 10));
        });
    }
}
