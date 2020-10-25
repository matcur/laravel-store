<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Store\Contracts\Models\HasImages;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
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
            ->map(function (HasImages $model) {
                $views = Image
                    ::factory()
                    ->count(rand(1, 10))
                    ->make()
                    ->toArray();
                return $model->images()->createMany($views);
            });
    }
}
