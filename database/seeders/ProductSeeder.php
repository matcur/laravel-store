<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\View;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory()
            ->count(15)
            ->create();

        (new ViewSeeder)->run($products);
        (new ImageSeeder)->run($products);
    }
}
