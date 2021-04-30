<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Genre::create([
            'genre' => 'fantasy'
        ]);

        Genre::create([
            'genre' => 'fiction'
        ]);

        Genre::create([
            'genre' => 'novel'
        ]);

        Genre::create([
            'genre' => 'action'
        ]);

        Genre::create([
            'genre' => 'science-fiction'
        ]);

        Genre::create([
            'genre' => 'mystery'
        ]);

        Genre::create([
            'genre' => 'historical'
        ]);

        Genre::create([
            'genre' => 'horror'
        ]);

        Genre::create([
            'genre' => 'romance'
        ]);

        Genre::create([
            'genre' => 'humor'
        ]);

        Genre::create([
            'genre' => 'comdey'
        ]);
    }
}
