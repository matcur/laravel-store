<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends AdminController
{
    public function show()
    {
        $popularProducts = Product::getPopular(10);
        $popularTodayProducts = Product::getPopularToday(10);

        return view('admin.dashboard', compact('popularProducts', 'popularTodayProducts'));
    }
}
