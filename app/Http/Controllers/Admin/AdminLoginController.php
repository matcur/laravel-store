<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends AdminController
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function redirectPath()
    {
        return RouteServiceProvider::DASHBOARD;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
