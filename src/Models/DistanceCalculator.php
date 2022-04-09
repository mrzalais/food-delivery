<?php

namespace App\Models;

class DistanceCalculator
{
    public function calculateTime(int|float $distance, int $speed): float|int
    {
        return $distance/$speed * 60;
    }

    public function getCountOfVisitedTilesInKilometers(string $stringWithPath): float
    {
        return substr_count($stringWithPath, '.') / 10;
    }
}
