<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Map;
use App\Models\Gps;
use App\Models\Order;
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

        $map->insertObject($order->coordinates, Map::TILE_TYPE_ORDER);

        $gps = new Gps($map);
        $tile = $gps->findByCoordinates($order->coordinates);

        $this->assertEquals(
            [0, 1, Map::TILE_TYPE_ORDER],
            [$tile->col, $tile->row, $tile->value]
        );
    }
}
