<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Order;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;

class OrderTest extends TestCase
{
    public function testItHasCoordinates(): void
    {
        $order = new Order([0, 0], [1, 1]);
        $this->assertEquals(['x' => 0, 'y' => 0], $order->coordinates);
    }

    public function testItHasDestinationCoordinates(): void
    {
        $order = new Order([0, 0], [1, 1]);
        $this->assertEquals(['x' => 1, 'y' => 1],$order->destinationCoordinates);
    }

    public function testItCanHaveACourier(): void
    {
        $order = new Order([0, 0], [1, 1]);
        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();
        $order->assignCourier($courier);

        $this->assertEquals($courier, $order->getCourier());
    }
}
