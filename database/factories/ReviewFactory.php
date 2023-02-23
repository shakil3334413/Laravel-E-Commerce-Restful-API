<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'=>Product::factory(),
            // 'product_id'=>function(){
            //     // Product::all()->random();
            //     return Product::factory();
            // },
            'customer'=>$this->faker->name,
            'review'=>$this->faker->paragraph,
            'star'=>$this->faker->numberBetween(1,5)
        ];
    }
}
