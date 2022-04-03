<?php

namespace App\Models;

use App\Exceptions\VehicleNotFoundException;

class Vehicle
{
    public const TYPE_BICYCLE = 'bicycle';
    public const TYPE_BIKE = 'bike';
    public const TYPE_CAR = 'car';

    private string $type;
    public int $averageSpeed;

    public function __construct(string $type)
    {
        $this->type = $type;
        switch ($type) {
            case self::TYPE_BICYCLE:
                $this->averageSpeed = 20;
                break;
            case self::TYPE_BIKE:
                $this->averageSpeed = 25;
                break;
            case self::TYPE_CAR:
                $this->averageSpeed = 24;
                break;
            default:
                throw new VehicleNotFoundException;
        }
    }
}
