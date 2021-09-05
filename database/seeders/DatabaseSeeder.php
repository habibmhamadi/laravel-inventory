<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $measurements = [
        ['name' => 'KG'],
        ['name' => 'Metre'],
        ['name' => 'Litre'],
        ['name' => 'Count']
    ];

    private $products = [
        [
            'name' => 'Meal',
            'measurement_id' => 1,
            'supplier_id' => 1,
            'price' => 120,
            'quantity' => 25
        ],
        [
            'name' => 'Apple',
            'measurement_id' => 1,
            'supplier_id' => 2,
            'price' => 15,
            'quantity' => 80
        ],
        [
            'name' => 'Oil',
            'measurement_id' => 3,
            'supplier_id' => 2,
            'price' => 45,
            'quantity' => 64
        ],
        [
            'name' => 'Rice',
            'measurement_id' => 1,
            'supplier_id' => 3,
            'price' => 32,
            'quantity' => 10450
        ],
        [
            'name' => 'Pepsi Can',
            'measurement_id' => 4,
            'supplier_id' => 1,
            'price' => 5,
            'quantity' => 200
        ]
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();

         \App\Models\Customer::factory(10)->create();
         \App\Models\Supplier::factory(10)->create();

         foreach ($this->measurements as $measurement)
         {
             \App\Models\Measurement::create($measurement);
         }
        foreach ($this->products as $product)
        {
            \App\Models\Product::create($product);
        }
    }
}
