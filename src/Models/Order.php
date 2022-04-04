<?php

namespace App\Models;

class Order
{
    public const STATUS_IN_PROGRESS = 'in progress';
    public const STATUS_FINISHED = 'finished';

    public string $status;

    public array $coordinates;
    public array $destinationCoordinates;
    private Courier $courier;

    public function __construct(array $orderCoordinates, array $destinationCoordinates)
    {
        $this->status = self::STATUS_IN_PROGRESS;
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

    public function complete(): void
    {
        $this->status = self::STATUS_FINISHED;
    }
}
