<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Gps;
use App\Models\Map;
use App\Models\Vehicle;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;
use App\Models\DistanceCalculator;

class DistanceCalculatorTest extends TestCase
{
    public function testItCanCalculateTimeNeededToTravelTheDistance(): void
    {
        $map = "C____|"
            . "_____|"
            . "_____|"
            . "_____|"
            . "____R|";

        $distanceCalculator = new DistanceCalculator;
        $map = new Map($map);
        $gps = new Gps($map);

        $pathFinder = new PathFinder(
            $gps->find('C'),
            $gps->find('R'),
            $map
        );

        $distance = $distanceCalculator->getCountOfVisitedTilesInKilometers($pathFinder->stringWithPath);

        $vehicle = new Vehicle(Vehicle::TYPE_BICYCLE);

        $time = $distanceCalculator->calculateTime($distance, $vehicle->averageSpeed);

        $this->assertEquals(1.5, $time);
    }
}
