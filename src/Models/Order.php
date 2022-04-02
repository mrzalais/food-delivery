<?php

namespace App\Models;

class Order
{
    public array $coordinates;
    public array $destinationCoordinates;
    private int $x;
    private int $y;
    private Courier $courier;

    public function __construct(int $x, int $y, array $destinationCoordinates)
    {
        $this->x = $x;
        $this->y = $y;
        $this->coordinates = ['x' => $x, 'y' => $y];
        $this->destinationCoordinates = $destinationCoordinates;
    }

    public function assignCourier(Courier $courier)
    {
        $this->courier = $courier;
    }

    public function getCourier(): Courier
    {
        return $this->courier;
    }
}
