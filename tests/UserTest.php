<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Order;
use App\Models\Recipient;
use PHPUnit\Framework\TestCase;
use Faker;

class UserTest extends TestCase
{
    public function testItCanHaveAOrder(): void
    {
        $faker = Faker\Factory::create();

        //TODO create factory
        $recipient = new Recipient(
            $faker->email(),
            $faker->phoneNumber(),
            $faker->address(),
        );

        $order = new Order(0, 0, [1, 1]);
        $recipient->setOrder($order);

        $this->assertEquals($recipient->getOrder(), $order);
    }

    //TODO it can have order history
}
