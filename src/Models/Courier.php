<?php

namespace App\Models;

class Courier extends User
{
    private array $activeDeliveries;
    private Vehicle $activeVehicle;
    private array $vehicles;
    public array $location;

    public function assignDelivery(Order $order): void
    {
        $this->activeDeliveries[] = $order;
        $order->setStatus(Order::STATUS_COURIER_ON_THE_WAY_TO_ORDER);
    }

    public function getActiveDeliveries(): array
    {
        return $this->activeDeliveries;
    }

    public function setActiveVehicle(Vehicle $vehicle): void
    {
        $this->activeVehicle = $vehicle;
    }

    public function getActiveVehicle(): Vehicle
    {
        return $this->activeVehicle;
    }

    public function addVehicle(Vehicle $vehicle): void
    {
        $this->vehicles[] = $vehicle;
    }

    public function getAllVehicles(): array
    {
        return $this->vehicles;
    }
}
