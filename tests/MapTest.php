<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Map;
use App\Models\Gps;
use App\Models\Order;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testItCanReceiveCoordinatesWhereToInsertObject(): void
    {
        $mapString = "BBBBBB|"
            . "______|"
            . "BBBBBB";
        $map = new Map($mapString);

        $order = new Order([0, 1], [5, 1]);

        $map->insertObject($order->coordinates, Map::TYPE_ORDER);

        $gps = new Gps($map);

        $this->assertEquals(
            ['x' => 0, 'y' => 1, 'type' => Map::TYPE_ORDER],
            $gps->getLocationOfItemByCoordinates($order->coordinates)
        );
    }
}
