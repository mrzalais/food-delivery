<?php

namespace App\Models;

class DistanceCalculator
{
    public function getDistanceBetweenTwoPoints(int $pointA, int $pointB): int
    {
        return abs($pointA - $pointB);
    }

    public function getEuclideanDistanceInKilometers(array $coordinatesA, array $coordinatesB, bool $roundedUp = true): float
    {
        if (!$roundedUp) {
            return sqrt(
                abs($coordinatesA['x'] - $coordinatesB['x'])**2
                + abs($coordinatesA['y'] - $coordinatesB['y'])**2
            ) / 10;
        }

        return ceil(
            sqrt(
                abs($coordinatesA['x'] - $coordinatesB['x'])**2
                + abs($coordinatesA['y'] - $coordinatesB['y'])**2
            )
        ) / 10;
    }

    public function calculateTime(int|float $distance, int $speed): float|int
    {
        return $distance/$speed * 60;
    }
}
