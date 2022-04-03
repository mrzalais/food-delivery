<?php

namespace App\Models;

class Order
{
    public array $coordinates;
    public array $destinationCoordinates;
    private Courier $courier;

    public function __construct(array $orderCoordinates, array $destinationCoordinates)
    {
        $this->coordinates = ['x' => $orderCoordinates[0], 'y' => $orderCoordinates[1]];
        $this->destinationCoordinates = ['x' => $destinationCoordinates[0], 'y' => $destinationCoordinates[1]];
    }

    public function assignCourier(Courier $courier): void
    {
        $this->courier = $courier;
    }

    public function getCourier(): Courier
    {
        return $this->courier;
    }
}
