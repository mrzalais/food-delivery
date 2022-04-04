<?php

namespace App\Models;

class DistanceCalculator
{
    public function getDistanceBetweenTwoPoints(int $pointA, int $pointB): int
    {
        return abs($pointA - $pointB);
    }

    public function getEuclideanDistanceInKilometers(array $coordinatesA, array $coordinatesB): float
    {
        return ceil(
            sqrt(
                abs($coordinatesA[0] - $coordinatesB[1])**2
                + abs($coordinatesA[0] - $coordinatesB[1])**2
            )
        ) / 10;
    }

    public function calculateTime(int|float $distance, int $speed): float|int
    {
        return $distance/$speed * 60;
    }
}
