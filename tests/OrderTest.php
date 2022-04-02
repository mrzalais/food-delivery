<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Order;
use App\Models\Courier;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testItHasCoordinates(): void
    {
        $order = new Order(0, 0, [1, 1]);
        $this->assertEquals(['x' => 0, 'y' => 0], $order->coordinates);
    }

    public function testItHasDestinationCoordinates(): void
    {
        $order = new Order(0, 0, [1, 1]);
        $this->assertEquals([1, 1],$order->destinationCoordinates);
    }

    public function testItCanHaveACourier(): void
    {
        $order = new Order(0, 0, [1, 1]);
        $courier = new Courier;
        $order->assignCourier($courier);

        $this->assertEquals($courier, $order->getCourier());
    }
}
