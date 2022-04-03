<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Gps;
use App\Models\Courier;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;
use App\Models\DistanceCalculator;

class DistanceCalculatorTest extends TestCase
{
    public function testItCanCalculateSimpleHorizontalDistance(): void
    {
        $map = "BBBBBB|"
            . "C____R|"
            . "BBBBBB";

        $parser = new MapParser;

        $gps = new Gps($map, $parser);
        $courierCoordinates = $gps->getLocationOfItem(MapParser::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItem(MapParser::TYPE_RECIPIENT);

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

        $parser = new MapParser;

        $gps = new Gps($map, $parser);
        $courierCoordinates = $gps->getLocationOfItem(MapParser::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItem(MapParser::TYPE_RECIPIENT);

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

        $parser = new MapParser;

        $gps = new Gps($map, $parser);
        $courierCoordinates = $gps->getLocationOfItem(MapParser::TYPE_COURIER);
        $recipientCoordinates = $gps->getLocationOfItem(MapParser::TYPE_RECIPIENT);

        $distanceCalculator = new DistanceCalculator;

        $diagonalDistance = $distanceCalculator->getEuclideanDistance(
            $courierCoordinates,
            $recipientCoordinates,
            true
        );

        $this->assertEquals(6, ceil($diagonalDistance));
    }
}
