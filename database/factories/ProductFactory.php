<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'total_review' => $this->faker->numberBetween(5, 100),
            'price' => $this->faker->randomFloat(null, 10, 100),
            'image_path' => '@logos/1IVVFLQob3gpTcEPXDDAYwMtrozeOl0MobGRIXEz.jpg',
            'colors' => null,
            'sizes' => null,
            'short_description' => $this->faker->paragraph(1),
            'long_description' => $this->faker->paragraph(2)
        ];
    }
}