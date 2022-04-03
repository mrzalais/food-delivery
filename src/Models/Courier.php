<?php

namespace App\Models;

class Courier extends User
{
    private array $activeDeliveries;
    private Vehicle $activeVehicle;
    private array $vehicles;
    private float $balance = 0;

    public function setActiveDelivery(Order $order): void
    {
        $this->activeDeliveries[] = $order;
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

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function addToBalance(Payment $payment): void
    {
        $this->balance += $payment->amount;
    }
}
