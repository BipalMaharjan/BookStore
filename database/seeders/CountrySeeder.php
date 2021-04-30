<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'countrycode' => '977',
            'countryname' => 'Nepal',
            'code' => '111'
        ]);

        Country::create([
            'countrycode' => '999',
            'countryname' => 'China',
            'code' => '454'
        ]);

        Country::create([
            'countrycode' => '111',
            'countryname' => 'USA',
            'code' => '1'
        ]);
    }
}
