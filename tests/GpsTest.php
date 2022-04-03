<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Gps;
use App\Models\Map;
use App\Models\Order;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class GpsTest extends TestCase
{
    public function testItReturnsCouriersCurrentLocation(): void
    {
        $map = new Map("_W|CW");
        $gps = new Gps($map);

        $location = $gps->getLocationOfItemByType(Map::TYPE_COURIER);

        $this->assertEquals(['x' => 0, 'y' => 1], $location);
    }

    public function testItReturnsFalseIfCurrentLocationIsNotFound(): void
    {
        $map = new Map("_W|BW");
        $gps = new Gps($map);

        $location = $gps->getLocationOfItemByType(Map::TYPE_COURIER);

        $this->assertFalse($location);
    }

    public function testItReturnsOrderLocation(): void
    {
        $map = new Map("_W|BO");

        $gps = new Gps($map);

        $order = new Order([1, 1], [2, 2]);

        $this->assertEquals(
            ['x' => 1, 'y' => 1, 'type' => Map::TYPE_ORDER],
            $gps->getLocationOfItemByCoordinates($order->coordinates)
        );
    }
}
