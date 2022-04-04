<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Map;
use App\Models\Payment;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;
use App\Models\PaymentCalculator;

class PaymentTest extends TestCase
{
    public function testItCanBePaidOutToCourier(): void
    {
        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();

        $this->assertEquals(0, $courier->getBalance());

        $payment = new Payment(5);
        $courier->addToBalance($payment);

        $this->assertEquals(5, $courier->getBalance());
    }

    public function testItIsPaidOutAfterSuccessfulDelivery(): void
    {
        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();

        $map = "CBBLLWLLWWWWLLBBR|
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

        $maze = Map::fromString($map);

        $pathFinder = new PathFinder(
            $maze->find('C'),
            $maze->find('R'),
            $maze
        );

        $pathFinder->initDijkstra();
        $pathFinder->getPath(true);

        $distance = $pathFinder->getDistanceOfVisitedTilesInKilometers();

        $paymentCalculator = new PaymentCalculator;
        $amount = $paymentCalculator->calculatePaymentByDistance($distance);

        $this->assertEquals(0, $courier->getBalance());

        $payment = new Payment($amount);
        $courier->addToBalance($payment);

        $this->assertEquals($amount, $courier->getBalance());
    }
}
