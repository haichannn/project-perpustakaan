<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\.\app\Models\Book.php>
 */
class BookFactory extends Factory
{

    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'publication_year' => $this->faker->year(),
            'category_id' => Categories::factory(),
            'stock' => $this->faker->numberBetween(1, 100),
            'isbn' => $this->faker->isbn13(),
        ];
    }
}
