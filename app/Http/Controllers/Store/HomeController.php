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
        $popularProductsPaginate = Product::getPopularsPaginate();

        return view('store.home', compact('popularProductsPaginate'));
    }
}
