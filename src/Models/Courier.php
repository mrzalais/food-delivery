<?php

namespace App\Models;

class Courier
{
    private array $activeDeliveries;

    public function setActiveDelivery(Order $order): void
    {
        $this->activeDeliveries[] = $order;
    }

    public function getActiveDeliveries(): array
    {
        return $this->activeDeliveries;
    }
}
