<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\View;
use App\Store\Contracts\Models\HasShowRoute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $productViews = $this->createModelView($products);
        DB::table('views')->insert($productViews);

        $categories = Category::all();
        $categoryViews = $this->createModelView($categories);
        DB::table('views')->insert($categoryViews);
    }

    private function createModelView(Collection $models)
    {
        $result = [];

        $models->map(function(HasShowRoute $m) use(&$result) {
            $routeKey = $m->getShowRoute();
            $result[] = View
                ::factory(['url' => $routeKey])
                ->count(rand(1, 4))
                ->make()
                ->toArray();
        });

        return array_merge(...$result);
    }
}
