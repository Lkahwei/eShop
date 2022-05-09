<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array2
     */
    public function definition()
    {
        
        $filename = 'sneaker-' . $this->faker->numberBetween(1,5) . '.jpg';
        return [
            //The 'path' here should be referring to the model $fillable
            'path' => "img/products/{$filename}"
        ];
    }

    public function user()
    {
        $filename = $this->faker->numberBetween(1,2) . '.jpg';
        return $this->state(
            [
                'path' => "img/users/{$filename}"
            ]   
        );
    }
}
