<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(5)
            ->create();

        User::factory()
            ->create([
                'is_admin' => 1,
                'email' => 'admin@gmail.com',
            ]);
    }
}
