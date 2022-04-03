<?php

namespace App\Factories;

use App\Models\Courier;
use Faker;

class CourierFactory
{
    public function newCourier(): Courier
    {
        $faker = Faker\Factory::create();

        return new Courier(
            $faker->email(),
            $faker->phoneNumber(),
            $faker->address(),
        );
    }
}