<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Gps;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class GpsTest extends TestCase
{
    public function testItCanReturnYourCurrentLocationInAGivenMap(): void
    {
        $map = "_W\nXW";

        $gps = new Gps($map, new MapParser);
        $location = $gps->getCurrentLocation();

        $this->assertEquals(['x' => 0, 'y' => 1], $location);
    }
}
