<?php

namespace App\Factories;

use Faker;
use App\Models\Recipient;

class RecipientFactory
{
    public function newRecipient(): Recipient
    {
        $faker = Faker\Factory::create();

        return new Recipient(
            $faker->email(),
            $faker->phoneNumber(),
            $faker->address(),
        );
    }
}