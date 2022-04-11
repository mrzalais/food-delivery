<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Map;
use App\Models\Gps;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Payment;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;
use App\Models\PaymentCalculator;
use App\Models\DistanceCalculator;

class OrderFlowTest extends TestCase
{
    public function testOrderFlow(): void
    {
        $string = "_BBLLWLLWWWWLLBB_|"
                . "L_BLLWLLWWWWLLBB_|"
                . "L_BBLLWLWWWWLLBB_|"
                . "LL_BLLWLWWWWLLBB_|"
                . "LLL_LLWLWWWWLLBB_|"
                . "LLLL_LWLWWWWLLBB_|"
                . "LLLLW_LLWWWWLLBB_|"
                . "LLLLWL_LWWWWLLB_B|"
                . "LLLLWL_LWWWWLB_BB|"
                . "LLLLWL_LWWWWL_BBB|"
                . "LLLLWL_LWWWWL_BBB|"
                . "LLLLWL___________";

        $map = new Map($string);
        $order = new Order([0, 0], [16, 0]);
        $vehicle = new Vehicle(Vehicle::TYPE_BICYCLE);
        $distanceCalculator = new DistanceCalculator;

        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();

        $this->assertEquals(Order::STATUS_WAITING_FOR_COURIER, $order->status);

        $courier->setActiveVehicle($vehicle);
        $courier->location = ['x' => 6, 'y' => 11];

        $courier->assignDelivery($order);
        $this->assertEquals(Order::STATUS_COURIER_ON_THE_WAY_TO_ORDER, $order->status);

        $map->insertObject($order->coordinates, Map::TILE_TYPE_ORDER);
        $map->insertObject($order->destinationCoordinates, Map::TILE_TYPE_RECIPIENT);
        $map->insertObject($courier->location, Map::TILE_TYPE_COURIER);

        $gps = new Gps($map);

        $pathFinder = new PathFinder(
            $gps->find('C'),
            $gps->find('O'),
            $map
        );

        $order->setStatus(Order::STATUS_COURIER_ON_THE_WAY_TO_RECIPIENT);
        $this->assertEquals(Order::STATUS_COURIER_ON_THE_WAY_TO_RECIPIENT, $order->status);

        $distance = $distanceCalculator->getCountOfVisitedTilesInKilometers($pathFinder->stringWithPath);

        $pathFinder = new PathFinder(
            $gps->find('O'),
            $gps->find('R'),
            $map
        );

        $distance += $distanceCalculator->getCountOfVisitedTilesInKilometers($pathFinder->stringWithPath);

        $this->assertEquals(4.0, $distance);

        $time = $distanceCalculator->calculateTime($distance, $vehicle->averageSpeed);

        $this->assertEquals(12, $time);

        $order->complete();
        $this->assertEquals(Order::STATUS_COMPLETED, $order->status);
        //Recipient should see approx time total/left

        $paymentCalculator = new PaymentCalculator;
        $amount = $paymentCalculator->calculatePayment($distance);

        $this->assertEquals(0, $courier->getBalance());

        $payment = new Payment($amount);
        $courier->receivePayment($payment);
        $this->assertEquals($amount, $courier->getBalance());
    }
}
