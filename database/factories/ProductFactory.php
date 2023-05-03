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
            'categories' => $this->faker->word(),
            'total_review' => $this->faker->numberBetween(1, 200),
            'price' => $this->faker->randomFloat(null, 1, 500),
            'image_path' => '@logos/1IVVFLQob3gpTcEPXDDAYwMtrozeOl0MobGRIXEz.jpg',
            'colors' => '@Green@Black',
            'sizes' => '@M@XL',
            'short_description' => $this->faker->paragraph(1),
            'long_description' => $this->faker->paragraph(2)
        ];
    }
}
