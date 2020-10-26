<?php

namespace Database\Seeders;

use App\Models\View;
use App\Store\Contracts\Models\Viewable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Collection $collection
     * @return void
     */
    public function run(Collection $collection)
    {
        $collection
            ->map(function (Viewable $model) {
                $views = View
                    ::factory()
                    ->count(rand(1, 10))
                    ->make()
                    ->toArray();
                return $model->views()->createMany($views);
            });
    }
}
