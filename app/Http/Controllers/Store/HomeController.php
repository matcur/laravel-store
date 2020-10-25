<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Store\Recommends\RecommendProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recommendProducts = RecommendProduct::get(request()->ip(), 10);
        $popularProductsPaginate = Product::getPopularsPaginate();

        return view('store.home', compact(
            'recommendProducts',
            'popularProductsPaginate'
        ));
    }
}
