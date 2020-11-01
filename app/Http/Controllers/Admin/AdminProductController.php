<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;

class AdminProductController extends AdminController
{
    public function index()
    {
        $table = $this->tableFrom(new Product);

        $table->addColumn('name', 'Name')
            ->setCallback(function () {
                return $this->getShowATag($this->name);
            });
        $table->addColumn('short_description', 'Short Description');
        $table->addColumn('price', 'Price')
            ->setCallback(function () {
                return "{$this->price} {$this->getCurrencySymbol()}";
            });

        return view('admin.store.products.index', compact('table'));
    }
}
