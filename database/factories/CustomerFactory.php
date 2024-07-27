<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        $faker = FakerFactory::create('id_ID');
        return [
            'title' => $faker->title,
            'name' => $faker->name,
            'gender' => $faker->randomElement(['male', 'female']),
            'phone_number' => $faker->phoneNumber,
            'image' => $faker->imageUrl,
            'email' => $faker->unique()->safeEmail,
        ];
    }
}
