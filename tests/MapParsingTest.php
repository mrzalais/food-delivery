<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class MapParsingTest extends TestCase
{
    public function testItShouldParseMap1()
    {
        $map = "_W\n_W";

        $mapParser = new MapParser();

        $parsedMap = $mapParser->parse($map);

        $this->assertEquals([0, 0, 'road'], $parsedMap);
        $this->assertEquals([1, 0, 'building'], $parsedMap);
        $this->assertEquals([0, 1, 'road'], $parsedMap);
        $this->assertEquals([1, 0, 'building'], $parsedMap);
    }
}
