<?php

namespace App\Models;

class Order
{
    public const STATUS_WAITING_FOR_COURIER = 'waiting for courier';
    public const STATUS_COURIER_ON_THE_WAY_TO_ORDER = 'courier on the way to order';
    public const STATUS_COURIER_ON_THE_WAY_TO_RECIPIENT = 'courier on the way to recipient';
    public const STATUS_COMPLETED = 'completed';

    public array $coordinates;
    public array $destinationCoordinates;
    private Courier $courier;
    public string $status;

    public function __construct(array $orderCoordinates, array $destinationCoordinates)
    {
        $this->status = self::STATUS_WAITING_FOR_COURIER;
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

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function complete(): void
    {
        $this->status = self::STATUS_COMPLETED;
    }
}
