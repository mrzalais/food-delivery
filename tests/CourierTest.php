<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Order;
use App\Models\Courier;
use PHPUnit\Framework\TestCase;

class CourierTest extends TestCase
{
    public function testItCanGetAssignedAnActiveDelivery(): void
    {
        $courier = new Courier();
        $order = new Order(1, 1, [2, 2]);
        $courier->setActiveDelivery($order);

        $this->assertEquals([$order], $courier->getActiveDeliveries());
    }
}
