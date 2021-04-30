<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $random = Str::random(40);
        Book::create([
            'book_id' => $random,
            'name' => 'book',
            'image' => 'book_image\B3ISTSWeDz2iimCix6dlEIhc1VR11gLJHBqc55ns.jpg',
            'author' => 'author',
            'price' => '420',
            'description' => 'This is a book',
            'seller_id' => 1,

        ]);
        $random = Str::random(40);

        Book::create([
            'book_id' => $random,
            'name' => 'book2',
            'image' => 'book_image\0kFKgIw8A4RBJmhrdcAaMDOzWSOP43z9UbCPAW2L.jpg',
            'author' => 'author2',
            'price' => '69',
            'description' => 'This is a book2',
            'seller_id' => 1,

        ]);
    }
}
