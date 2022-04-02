<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Order;
use App\Models\Courier;
use App\Models\Vehicle;
use PHPUnit\Framework\TestCase;

class CourierTest extends TestCase
{
    public function testItCanGetAssignedAnActiveDelivery(): void
    {
        $courier = new Courier();
        $order = new Order(1, 1, [2, 2]);
        $courier->setActiveDelivery($order);

        $this->assertEquals([$order], $courier->getActiveDeliveries());
    }

    public function testItCanHaveAVehicle(): void
    {
        $courier = new Courier();
        $vehicle = new Vehicle(Vehicle::TYPE_BICYCLE, 15);
        $courier->setActiveVehicle($vehicle);

        $this->assertEquals($vehicle, $courier->getActiveVehicle());
    }

    public function testItCanMultipleVehiclesButOnlyOneActiveOne(): void
    {
        $courier = new Courier();
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
        $courier = new Courier();
        $bicycle = new Vehicle(Vehicle::TYPE_BICYCLE, 20);
        $car = new Vehicle(Vehicle::TYPE_CAR, 25);

        $courier->setActiveVehicle($bicycle);

        $this->assertEquals($bicycle, $courier->getActiveVehicle());

        $courier->setActiveVehicle($car);

        $this->assertEquals($car, $courier->getActiveVehicle());
    }
}
