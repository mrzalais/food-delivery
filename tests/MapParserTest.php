<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

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

        $parsedMap = $mapParser->parse($map);

        $this->assertEquals($result, $parsedMap);
    }

    public function provider(): array
    {
        return [
            [
            'map' => "_B|_B",
            'result' =>
                [
                    [
                        ['x' => 0, 'y' => 0, 'type' => Map::TYPE_ROAD],
                        ['x' => 1, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                    ],
                    [
                        ['x' => 0, 'y' => 1, 'type' => Map::TYPE_ROAD],
                        ['x' => 1, 'y' => 1, 'type' => Map::TYPE_BUILDING],
                    ]
                ],
            ],
            [
                'map' => "_BWW|_BWW",
                'result' =>
                    [
                        [
                            ['x' => 0, 'y' => 0, 'type' => Map::TYPE_ROAD],
                            ['x' => 1, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                            ['x' => 2, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 3, 'y' => 0, 'type' => Map::TYPE_WATER],
                        ],
                        [
                            ['x' => 0, 'y' => 1, 'type' => Map::TYPE_ROAD],
                            ['x' => 1, 'y' => 1, 'type' => Map::TYPE_BUILDING],
                            ['x' => 2, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 3, 'y' => 1, 'type' => Map::TYPE_WATER],
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
                            ['x' => 0, 'y' => 0, 'type' => Map::TYPE_ROAD],
                            ['x' => 1, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                            ['x' => 2, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                            ['x' => 3, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 5, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 6, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 7, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 0, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 0, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 0, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 0, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 1, 'type' => Map::TYPE_ROAD],
                            ['x' => 2, 'y' => 1, 'type' => Map::TYPE_BUILDING],
                            ['x' => 3, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 5, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 6, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 7, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 1, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 1, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 1, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 1, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 1, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 2, 'type' => Map::TYPE_ROAD],
                            ['x' => 2, 'y' => 2, 'type' => Map::TYPE_BUILDING],
                            ['x' => 3, 'y' => 2, 'type' => Map::TYPE_BUILDING],
                            ['x' => 4, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 5, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 2, 'type' => Map::TYPE_WATER],
                            ['x' => 7, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 2, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 2, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 2, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 2, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 2, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 2, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 2, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 2, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 3, 'type' => Map::TYPE_ROAD],
                            ['x' => 3, 'y' => 3, 'type' => Map::TYPE_BUILDING],
                            ['x' => 4, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 5, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 3, 'type' => Map::TYPE_WATER],
                            ['x' => 7, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 3, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 3, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 3, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 3, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 3, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 3, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 3, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 3, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 4, 'type' => Map::TYPE_ROAD],
                            ['x' => 4, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 5, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 4, 'type' => Map::TYPE_WATER],
                            ['x' => 7, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 4, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 4, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 4, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 4, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 4, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 4, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 4, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 4, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 5, 'type' => Map::TYPE_ROAD],
                            ['x' => 5, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 5, 'type' => Map::TYPE_WATER],
                            ['x' => 7, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 5, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 5, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 5, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 5, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 5, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 5, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 5, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 5, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 6, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 6, 'type' => Map::TYPE_ROAD],
                            ['x' => 6, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 7, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 6, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 6, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 6, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 6, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 6, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 6, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 6, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 6, 'type' => Map::TYPE_ROAD],
                        ],
                        [
                            ['x' => 0, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 7, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 7, 'type' => Map::TYPE_ROAD],
                            ['x' => 7, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 7, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 7, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 7, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 7, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 7, 'type' => Map::TYPE_LAND],
                            ['x' => 14, 'y' => 7, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 7, 'type' => Map::TYPE_ROAD],
                            ['x' => 16, 'y' => 7, 'type' => Map::TYPE_BUILDING],
                        ],
                        [
                            ['x' => 0, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 8, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 8, 'type' => Map::TYPE_ROAD],
                            ['x' => 7, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 8, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 8, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 8, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 8, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 8, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 8, 'type' => Map::TYPE_BUILDING],
                            ['x' => 14, 'y' => 8, 'type' => Map::TYPE_ROAD],
                            ['x' => 15, 'y' => 8, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 8, 'type' => Map::TYPE_BUILDING],
                        ],
                        [
                            ['x' => 0, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 9, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 9, 'type' => Map::TYPE_ROAD],
                            ['x' => 7, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 9, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 9, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 9, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 9, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 9, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 9, 'type' => Map::TYPE_ROAD],
                            ['x' => 14, 'y' => 9, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 9, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 9, 'type' => Map::TYPE_BUILDING],
                        ],
                        [
                            ['x' => 0, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 10, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 10, 'type' => Map::TYPE_ROAD],
                            ['x' => 7, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 8, 'y' => 10, 'type' => Map::TYPE_WATER],
                            ['x' => 9, 'y' => 10, 'type' => Map::TYPE_WATER],
                            ['x' => 10, 'y' => 10, 'type' => Map::TYPE_WATER],
                            ['x' => 11, 'y' => 10, 'type' => Map::TYPE_WATER],
                            ['x' => 12, 'y' => 10, 'type' => Map::TYPE_LAND],
                            ['x' => 13, 'y' => 10, 'type' => Map::TYPE_ROAD],
                            ['x' => 14, 'y' => 10, 'type' => Map::TYPE_BUILDING],
                            ['x' => 15, 'y' => 10, 'type' => Map::TYPE_BUILDING],
                            ['x' => 16, 'y' => 10, 'type' => Map::TYPE_BUILDING],
                        ],
                        [
                            ['x' => 0, 'y' => 11, 'type' => Map::TYPE_LAND],
                            ['x' => 1, 'y' => 11, 'type' => Map::TYPE_LAND],
                            ['x' => 2, 'y' => 11, 'type' => Map::TYPE_LAND],
                            ['x' => 3, 'y' => 11, 'type' => Map::TYPE_LAND],
                            ['x' => 4, 'y' => 11, 'type' => Map::TYPE_WATER],
                            ['x' => 5, 'y' => 11, 'type' => Map::TYPE_LAND],
                            ['x' => 6, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 7, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 8, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 9, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 10, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 11, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 12, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 13, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 14, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 15, 'y' => 11, 'type' => Map::TYPE_ROAD],
                            ['x' => 16, 'y' => 11, 'type' => Map::TYPE_ROAD],
                        ],
                    ],
            ],
        ];
    }
}
