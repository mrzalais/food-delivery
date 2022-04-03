<?php

namespace App\Models;

class DistanceCalculator
{
    public function getDistanceBetweenTwoPoints(int $pointA, int $pointB): int
    {
        return abs($pointA - $pointB);
    }

    public function getEuclideanDistance(array $coordinatesA, array $coordinatesB, bool $roundedUp = true): int
    {
        if (!$roundedUp) {
            return sqrt(
                abs($coordinatesA['x'] - $coordinatesB['x'])**2
                + abs($coordinatesA['y'] - $coordinatesB['y'])**2
            );
        }

        return ceil(
            sqrt(
                abs($coordinatesA['x'] - $coordinatesB['x'])**2
                + abs($coordinatesA['y'] - $coordinatesB['y'])**2
            )
        );
    }
}
