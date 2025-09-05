<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\CategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call the seeders for categories and books
        $this->call([
            CategoriesSeeder::class,
            BookSeeder::class
        ]);
    }
}
