<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    //php artisan make:factory ProductFactory (Singular and Camel Cases) --model=Product
    public function definition()
    {

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(1),
            'price' => $this->faker->randomFloat($maxDecimal = 2, $min = 3, $max = 100),
            'stock' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
