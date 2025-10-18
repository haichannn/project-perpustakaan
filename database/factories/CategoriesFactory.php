<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    protected $model = Categories::class;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    private static $defaultCategories = [
        'Komputer',
        'Jaringan komputer',
        'Programming',
        'Cyber securiry'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(self::$defaultCategories),
        ];
    }
}
