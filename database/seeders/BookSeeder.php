<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Categories;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 books, each associated with a random category
        // using the factory method and recycling categories
        Book::factory()->recycle(Categories::all())
            ->count(50)
            ->create();

    }
}
