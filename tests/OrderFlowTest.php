<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Map;
use App\Models\Order;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;

class OrderFlowTest extends TestCase
{
    public function testOrderFlow(): void
    {
        $string = "_BBLLWLLWWWWLLBB_|
L_BLLWLLWWWWLLBB_|
L_BBLLWLWWWWLLBB_|
LL_BLLWLWWWWLLBB_|
LLL_LLWLWWWWLLBB_|
LLLL_LWLWWWWLLBB_|
LLLLW_LLWWWWLLBB_|
LLLLWL_LWWWWLLB_B|
LLLLWL_LWWWWLB_BB|
LLLLWL_LWWWWL_BBB|
LLLLWL_LWWWWL_BBB|
LLLLWL___________";
        $map = new Map($string);

        $order = new Order([0, 0], [16, 0]);
        $this->assertEquals(Order::STATUS_WAITING_FOR_COURIER, $order->status);
        //New order and recipient placed on map
        $map->insertObject($order->coordinates, Map::TILE_TYPE_ORDER);
        $map->insertObject($order->destinationCoordinates, Map::TILE_TYPE_RECIPIENT);

        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();
        $courier->location = ['x' => 6, 'y' => 11];

        $courier->assignDelivery($order);
        $this->assertEquals(Order::STATUS_COURIER_ON_THE_WAY_TO_ORDER, $order->status);

        $map->insertObject($courier->location, Map::TILE_TYPE_COURIER);

        $pathFinder = new PathFinder(
            $map->find('C'),
            $map->find('O'),
            $map
        );

        $pathFinder->initDijkstra();

        $order->setStatus(Order::STATUS_COURIER_ON_THE_WAY_TO_RECIPIENT);
        $this->assertEquals(Order::STATUS_COURIER_ON_THE_WAY_TO_RECIPIENT, $order->status);

        $distance = $pathFinder->getCountOfVisitedTilesInKilometers();

        $pathFinder = new PathFinder(
            $map->find('O'),
            $map->find('R'),
            $map
        );

        $pathFinder->initDijkstra();

        $distance += $pathFinder->getCountOfVisitedTilesInKilometers();

        $order->complete();
        $this->assertEquals(Order::STATUS_COMPLETED, $order->status);
        //Recipient should see approx time total/left


        //Courier picks up order which updates order status
        //Courier receives payment
    }
}
