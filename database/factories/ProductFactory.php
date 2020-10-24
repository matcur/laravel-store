<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        $currencies = Currency::all();
        $categories = Category::all();

        return [
            'currency_id' => $currencies->random()->id,
            'category_id' => $categories->random()->id,
            'price' => rand(1000, 10000),
            'name' => $faker->title,
            'description' => $faker->realText(50),
            'short_description' => $faker->realText(20),
        ];
    }
}
