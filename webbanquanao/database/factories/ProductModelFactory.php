<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductModel;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
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
            'name'=> $this->faker->name,
            'slug'=> $this->faker->slug,
            'code'=> $this->faker->code,
            'weigth'=> $this->faker->weight,
            'dimension'=> $this->faker->dimension,
            'content'=> $this->faker->content,
            'material'=> $this->faker->material,
            'quantity'=> $this->faker->quantity,
            'price'=> $this->faker->price,
            'status'=> $this->faker->status,
            'category_id'=> $this->faker->category_id,
        ];
    }
}
