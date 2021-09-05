<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'supplier_id' => $this->faker->numberBetween(1, 10),
            'measurement_id' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(10, 10000),
            'quantity' => $this->faker->randomNumber()
        ];
    }
}
