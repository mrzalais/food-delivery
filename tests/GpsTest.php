<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Gps;
use App\Models\Map;
use PHPUnit\Framework\TestCase;

class GpsTest extends TestCase
{
    public function testItReturnsCouriersCurrentLocation(): void
    {
        $map = new Map("_W|CW");
        $gps = new Gps($map);

        $location = $gps->getLocationOfItemByType(Map::TILE_TYPE_COURIER);

        $this->assertEquals([0, 1], [$location->col, $location->row]);
    }

    public function testItReturnsFalseIfCurrentLocationIsNotFound(): void
    {
        $map = new Map("_W|BW");
        $gps = new Gps($map);

        $location = $gps->getLocationOfItemByType(Map::TYPE_COURIER);

        $this->assertNull($location);
    }
}
