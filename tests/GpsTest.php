<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Gps;
use App\Models\Delivery;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class GpsTest extends TestCase
{
    public function testItReturnsUsersCurrentLocation(): void
    {
        $map = "_W|XW";

        $gps = new Gps($map, new MapParser);
        $location = $gps->getLocationOfItem(MapParser::TYPE_USER);

        $this->assertEquals(['x' => 0, 'y' => 1], $location);
    }

    public function testItReturnsFalseIfCurrentLocationIsNotFound(): void
    {
        $map = "_W|BW";

        $gps = new Gps($map, new MapParser);
        $location = $gps->getLocationOfItem(MapParser::TYPE_USER);

        $this->assertFalse($location);
    }

    public function testItReturnsDeliveryLocation(): void
    {
        $map = "_W|BD";

        $gps = new Gps($map, new MapParser);

        $delivery = new Delivery(1, 1);

        $gps->initDelivery($delivery);

        $this->assertEquals(['x' => 1, 'y' => 1], $gps->delivery->coordinates);
    }
}
