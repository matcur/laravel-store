<?php


namespace App\Store\Services;


use App\Models\View;

class ViewService
{
    public function getProductsByColumn($column, $value)
    {
        return View::products()
            ->with('viewable')
            ->where($column, $value)
            ->get()
            ->pluck('viewable');
    }
}
