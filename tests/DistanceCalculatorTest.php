<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Gps;
use App\Models\Map;
use App\Models\Vehicle;
use PHPUnit\Framework\TestCase;
use App\Models\DistanceCalculator;

class DistanceCalculatorTest extends TestCase
{
    public function testItCanCalculateSimpleHorizontalDistance(): void
    {
        $map = "BBBBBB|"
            . "C____R|"
            . "BBBBBB";

        $map = new Map($map);
        $gps = new Gps($map);
        $courierCoordinates = $gps->getLocationOfItemByType(Map::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItemByType(Map::TYPE_RECIPIENT);

        $distanceCalculator = new DistanceCalculator;

        $horizontalDistance = $distanceCalculator->getDistanceBetweenTwoPoints(
            $courierCoordinates['x'],
            $recipientCoordinates['x']
        );

        $this->assertEquals(5, $horizontalDistance);
    }

    public function testItCanCalculateSimpleVerticalDistance(): void
    {
        $map = "BBCBB|"
            . "BB_BB|"
            . "BB_BB|"
            . "BB_BB|"
            . "BB_BB|"
            . "BBRBB";

        $map = new Map($map);
        $gps = new Gps($map);

        $courierCoordinates = $gps->getLocationOfItemByType(Map::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItemByType(Map::TYPE_RECIPIENT);

        $distanceCalculator = new DistanceCalculator;

        $verticalDistance = $distanceCalculator->getDistanceBetweenTwoPoints(
            $courierCoordinates['y'],
            $recipientCoordinates['y']
        );

        $this->assertEquals(5, $verticalDistance);
    }

    public function testItCanCalculateSimpleDiagonalDistanceInAPerfectScenario(): void
    {
        $map = "C____|"
            . "_____|"
            . "_____|"
            . "_____|"
            . "____R|";

        $map = new Map($map);
        $gps = new Gps($map);

        $courierCoordinates = $gps->getLocationOfItemByType(Map::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItemByType(Map::TYPE_RECIPIENT);

        $distanceCalculator = new DistanceCalculator;

        $diagonalDistance = $distanceCalculator->getEuclideanDistanceInKilometers(
            $courierCoordinates,
            $recipientCoordinates
        );

        $this->assertEquals(0.6, $diagonalDistance);
    }

    public function testItCanCalculateTimeNeededToTravelTheDistance(): void
    {
        $map = "C____|"
            . "_____|"
            . "_____|"
            . "_____|"
            . "____R|";

        $map = new Map($map);
        $gps = new Gps($map);

        $courierCoordinates = $gps->getLocationOfItemByType(Map::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItemByType(Map::TYPE_RECIPIENT);

        $distanceCalculator = new DistanceCalculator;

        $diagonalDistance = $distanceCalculator->getEuclideanDistanceInKilometers(
            $courierCoordinates,
            $recipientCoordinates
        );

        $vehicle = new Vehicle(Vehicle::TYPE_BICYCLE);

        $time = $distanceCalculator->calculateTime($diagonalDistance, $vehicle->averageSpeed);

        $this->assertEquals(1.8, $time);
    }
}
