<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Order;
use App\Models\Vehicle;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;

class CourierTest extends TestCase
{
    public function testItCanGetAssignedAnActiveDelivery(): void
    {
        $factory = new CourierFactory;
        $courier = $factory->newCourier();

        $order = new Order([1, 1], [2, 2]);
        $courier->setActiveDelivery($order);

        $this->assertEquals([$order], $courier->getActiveDeliveries());
    }

    public function testItCanHaveMultipleActiveDeliveriesSimultaneously(): void
    {
        $factory = new CourierFactory;
        $courier = $factory->newCourier();

        $orderA = new Order([1, 1], [2, 2]);
        $courier->setActiveDelivery($orderA);

        $orderB = new Order([2, 2], [3, 3]);
        $courier->setActiveDelivery($orderB);

        $this->assertEquals([$orderA, $orderB], $courier->getActiveDeliveries());
    }

    public function testItCanHaveAVehicle(): void
    {
        $factory = new CourierFactory;
        $courier = $factory->newCourier();

        $vehicle = new Vehicle(Vehicle::TYPE_BICYCLE, 15);
        $courier->setActiveVehicle($vehicle);

        $this->assertEquals($vehicle, $courier->getActiveVehicle());
    }

    public function testItCanMultipleVehiclesButOnlyOneActiveOne(): void
    {
        $factory = new CourierFactory;
        $courier = $factory->newCourier();

        $bicycle = new Vehicle(Vehicle::TYPE_BICYCLE, 20);
        $car = new Vehicle(Vehicle::TYPE_CAR, 25);
        $courier->addVehicle($bicycle);
        $courier->addVehicle($car);

        $courier->setActiveVehicle($bicycle);

        $this->assertEquals($bicycle, $courier->getActiveVehicle());
        $this->assertContains($bicycle, $courier->getAllVehicles());
        $this->assertContains($car, $courier->getAllVehicles());
    }

    public function testSettingNewActiveVehicleOverridesPreviousOne(): void
    {
        $factory = new CourierFactory;
        $courier = $factory->newCourier();

        $bicycle = new Vehicle(Vehicle::TYPE_BICYCLE, 20);
        $car = new Vehicle(Vehicle::TYPE_CAR, 25);

        $courier->setActiveVehicle($bicycle);

        $this->assertEquals($bicycle, $courier->getActiveVehicle());

        $courier->setActiveVehicle($car);

        $this->assertEquals($car, $courier->getActiveVehicle());
    }
}
