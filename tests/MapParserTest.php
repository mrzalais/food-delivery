<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class MapParserTest extends TestCase
{
    public function testItShouldParseMap1(): void
    {
        $map = "_W\n_W";

        $mapParser = new MapParser();

        $parsedMap = $mapParser->parse($map);

        $this->assertEquals(['x' => 0, 'y' => 0, 'type' => 'road'], $parsedMap[0]);
        $this->assertEquals(['x' => 1, 'y' => 0, 'type' => 'building'], $parsedMap[1]);
        $this->assertEquals(['x' => 0, 'y' => 1, 'type' => 'road'], $parsedMap[2]);
        $this->assertEquals(['x' => 1, 'y' => 1, 'type' => 'building'], $parsedMap[3]);
    }
}
