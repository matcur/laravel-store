<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    private array $currencies = [
        [
            'name' => 'RU',
            'symbol' => '',
        ],
        [
            'name' => 'EU',
            'symbol' => '',
        ],
        [
            'name' => 'USA',
            'symbol' => '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert($this->currencies);
    }
}
