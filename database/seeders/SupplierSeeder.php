<?php

namespace Database\Seeders;

use App\Models\supplier;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = FakerFactory::create(); // Create a new Faker instance

        supplier::create([
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'componey_name' => $faker->company,
            'address' => $faker->address,
            'order' => rand(0,9),
        ]);
    }
}
