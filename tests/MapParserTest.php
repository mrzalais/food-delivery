<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Map;
use App\Models\MapParser;
use PHPUnit\Framework\TestCase;

class MapParserTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testItShouldParseMaps(string $map, array $result): void
    {
        $mapParser = new MapParser();

        $map = $mapParser->fromString($map);

        $this->assertEquals($result, $map->tiles);
    }

    public function provider(): array
    {
        return [
            [
            'map' => "_B|_B",
            'result' =>
                [
                    [
                        (object) ['col' => 0, 'row' => 0, 'value' => Map::TILE_TYPE_ROAD],
                        (object) ['col' => 1, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                    ],
                    [
                        (object) ['col' => 0, 'row' => 1, 'value' => Map::TILE_TYPE_ROAD],
                        (object) ['col' => 1, 'row' => 1, 'value' => Map::TILE_TYPE_BUILDING],
                    ]
                ],
            ],
            [
                'map' => "_BWW|_BWW",
                'result' =>
                    [
                        [
                            (object) ['col' => 0, 'row' => 0, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 1, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 2, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 3, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 1, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 1, 'row' => 1, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 2, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 3, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                        ]
                    ],
            ],
            [
                'map' => "_BBLLWLLWWWWLLBB_|
L_BLLWLLWWWWLLBB_|
L_BBLLWLWWWWLLBB_|
LL_BLLWLWWWWLLBB_|
LLL_LLWLWWWWLLBB_|
LLLL_LWLWWWWLLBB_|
LLLLW_LLWWWWLLBB_|
LLLLWL_LWWWWLLB_B|
LLLLWL_LWWWWLB_BB|
LLLLWL_LWWWWL_BBB|
LLLLWL_LWWWWL_BBB|
LLLLWL___________",
                'result' =>
                    [
                        [
                            (object) ['col' => 0, 'row' => 0, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 1, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 2, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 3, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 5, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 6, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 7, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 0, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 0, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 0, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 0, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 1, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 2, 'row' => 1, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 3, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 5, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 6, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 7, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 1, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 1, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 1, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 1, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 1, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 2, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 2, 'row' => 2, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 3, 'row' => 2, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 4, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 5, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 2, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 7, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 2, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 2, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 2, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 2, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 2, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 2, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 2, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 2, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 3, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 3, 'row' => 3, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 4, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 5, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 3, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 7, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 3, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 3, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 3, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 3, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 3, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 3, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 3, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 3, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 4, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 4, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 5, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 4, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 7, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 4, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 4, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 4, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 4, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 4, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 4, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 4, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 4, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 5, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 5, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 5, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 7, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 5, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 5, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 5, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 5, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 5, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 5, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 5, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 5, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 6, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 6, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 6, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 7, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 6, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 6, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 6, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 6, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 6, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 6, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 6, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 6, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 7, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 7, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 7, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 7, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 7, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 7, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 7, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 7, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 14, 'row' => 7, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 7, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 16, 'row' => 7, 'value' => Map::TILE_TYPE_BUILDING],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 8, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 8, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 7, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 8, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 8, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 8, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 8, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 8, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 8, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 14, 'row' => 8, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 15, 'row' => 8, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 8, 'value' => Map::TILE_TYPE_BUILDING],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 9, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 9, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 7, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 9, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 9, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 9, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 9, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 9, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 9, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 14, 'row' => 9, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 9, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 9, 'value' => Map::TILE_TYPE_BUILDING],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 10, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 10, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 7, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 8, 'row' => 10, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 9, 'row' => 10, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 10, 'row' => 10, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 11, 'row' => 10, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 12, 'row' => 10, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 13, 'row' => 10, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 14, 'row' => 10, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 15, 'row' => 10, 'value' => Map::TILE_TYPE_BUILDING],
                            (object) ['col' => 16, 'row' => 10, 'value' => Map::TILE_TYPE_BUILDING],
                        ],
                        [
                            (object) ['col' => 0, 'row' => 11, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 1, 'row' => 11, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 2, 'row' => 11, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 3, 'row' => 11, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 4, 'row' => 11, 'value' => Map::TILE_TYPE_WATER],
                            (object) ['col' => 5, 'row' => 11, 'value' => Map::TILE_TYPE_LAND],
                            (object) ['col' => 6, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 7, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 8, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 9, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 10, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 11, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 12, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 13, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 14, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 15, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                            (object) ['col' => 16, 'row' => 11, 'value' => Map::TILE_TYPE_ROAD],
                        ],
                    ],
            ],
        ];
    }
}
