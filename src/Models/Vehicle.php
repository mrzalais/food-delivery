<?php

namespace App\Models;

class Vehicle
{
    public const TYPE_BICYCLE = 'bicycle';
    public const TYPE_BIKE = 'bike';
    public const TYPE_CAR = 'car';

    private string $type;
    private int $averageSpeed;

    public function __construct(string $type, int $averageSpeed)
    {
        $this->type = $type;
        $this->averageSpeed = $averageSpeed;
    }
}
