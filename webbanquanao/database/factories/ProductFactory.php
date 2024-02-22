<?php

namespace Database\Factories;
use App\Models\ProductModel;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductFactory extends Factory
{
    protected $model = ProductModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image_path' => $this->faker->imageUrl(640, 480, 'nature'),
        ];
    }
}
