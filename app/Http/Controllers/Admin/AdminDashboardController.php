<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends AdminController
{
    public function show()
    {
        return view('admin.dashboard');
    }
}
