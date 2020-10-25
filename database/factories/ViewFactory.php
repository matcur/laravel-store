<?php

namespace Database\Factories;

use App\Models\View;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = View::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $localDebIp = '127.0.0.1';
        $faker = $this->faker;

        return [
            'ip' => rand(0, 5) > 2? $faker->ipv4: $localDebIp,
        ];
    }
}
