<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\User;
use App\Models\Order;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testItCanHaveAOrder(): void
    {
        $user = new User;
        $order = new Order(0, 0, [1, 1]);
        $user->setOrder($order);

        $this->assertEquals($user->getOrder(), $order);
    }

    //TODO it can have order history
}
