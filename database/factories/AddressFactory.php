<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        $faker = FakerFactory::create('id_ID');
        return [
            'customer_id' => Customer::factory(),
            'address' => $faker->streetAddress,
            'district' => $faker->city,
            'city' => $faker->city,
            'province' => $faker->city,
            'postal_code' => $faker->postcode
        ];
    }
}
