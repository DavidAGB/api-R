<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{


    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->unique()->sentence(2);
        return [
            'name' => $name,
            'price' => $this->faker->randomElement([19.99, 29.99, 39.99]),
            'description' => $this->faker->text(50),
            'image' =>'product/'.$this->faker->image('public/storage/product', 640 , 480, null ,false),
        ];
    }
}
