<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Map;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;
use App\Models\PaymentCalculator;

class OrderFlowTest extends TestCase
{
    public function testItIsPaidOutAfterSuccessfulDelivery(): void
    {
        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();

        $map = "_________________|
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

        $map = new Map($map);

        $order = new Order([0, 0], [16, 0]);
        $map->insertObject($order->coordinates, Map::TILE_TYPE_ORDER);
        $map->insertObject($order->destinationCoordinates, Map::TILE_TYPE_RECIPIENT);

        $courier->coordinates = ['x' => 6, 'y' => 11];

        $map->insertObject($courier->coordinates, Map::TILE_TYPE_COURIER);

        $pathFinder = new PathFinder(
            $map->find('C'),
            $map->find('O'),
            $map
        );

        $pathFinder->initDijkstra();
        $pathFinder->getPath(true);

        $distance = $pathFinder->getDistanceOfVisitedTilesInKilometers();

        $pathFinder = new PathFinder(
            $map->find('O'),
            $map->find('R'),
            $map
        );

        $pathFinder->initDijkstra();
        $pathFinder->getPath(true);

        $order->complete();

        $this->assertEquals(Order::STATUS_FINISHED, $order->status);

        $distance += $pathFinder->getDistanceOfVisitedTilesInKilometers();

        $paymentCalculator = new PaymentCalculator;
        $amount = $paymentCalculator->calculatePaymentByDistance($distance);

        $this->assertEquals(0, $courier->getBalance());

        $payment = new Payment($amount);
        $courier->addToBalance($payment);

        $this->assertEquals($amount, $courier->getBalance());
    }
}
