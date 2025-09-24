<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'published_year' => fake()->year(),
            // ISBN akan diatur oleh Seeder untuk memastikan urutan dan keunikan
            'isbn' => fake()->unique()->isbn13(),
            'stock' => fake()->numberBetween(1, 20),
        ];
    }
}
