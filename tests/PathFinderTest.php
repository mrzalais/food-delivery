<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Map;
use App\Models\Gps;
use App\Models\PathFinder;
use PHPUnit\Framework\TestCase;

class PathFinderTest extends TestCase
{
    /**
     * @dataProvider provider
     * @param string $map
     * @param string $result
     * @return void
     */
    public function testItCanFindEndingOfAMaze(string $map, string $result): void
    {
        $map = new Map($map);

        $gps = new Gps($map);

        $pathFinder = new PathFinder(
            $gps->find('C'),
            $gps->find('R'),
            $map
        );

        $pathFinder->initDijkstra();

        $mazeStringWithPath = $pathFinder->getPath(true);

        $this->assertEquals(
            $result,
            $mazeStringWithPath
        );
    }

    public function provider(): array
    {
        return [
            [
                'map' => "CBBLLWLLWWWWLLBBR|"
                       . "L_BLLWLLWWWWLLBB_|"
                       . "L_BBLLWLWWWWLLBB_|"
                       . "LL_BLLWLWWWWLLBB_|"
                       . "LLL_LLWLWWWWLLBB_|"
                       . "LLLL_LWLWWWWLLBB_|"
                       . "LLLLW_LLWWWWLLBB_|"
                       . "LLLLWL_LWWWWLLB_B|"
                       . "LLLLWL_LWWWWLB_BB|"
                       . "LLLLWL_LWWWWL_BBB|"
                       . "LLLLWL_LWWWWL_BBB|"
                       . "LLLLWL___________",
                'result' => ".BBLLWLLWWWWLLBB.\n"
                          . "L.BLLWLLWWWWLLBB.\n"
                          . "L.BBLLWLWWWWLLBB.\n"
                          . "LL.BLLWLWWWWLLBB.\n"
                          . "LLL.LLWLWWWWLLBB.\n"
                          . "LLLL.LWLWWWWLLBB.\n"
                          . "LLLLW.LLWWWWLLBB.\n"
                          . "LLLLWL.LWWWWLLB.B\n"
                          . "LLLLWL.LWWWWLB.BB\n"
                          . "LLLLWL.LWWWWL.BBB\n"
                          . "LLLLWL.LWWWWL.BBB\n"
                          . "LLLLWL_......____"
            ],
            [
                'map' => "CBBLLWLLWWWWLLBBR|"
                       . "L_BLLWLLWWWWLLBB_|"
                       . "L________________|"
                       . "LL_BLLWLWWWWLLBB_|"
                       . "LLL_LLWLWWWWLLBB_|"
                       . "LLLL_LWLWWWWLLBB_|"
                       . "LLLLW_LLWWWWLLBB_|"
                       . "LLLLWL_LWWWWLLB_B|"
                       . "LLLLWL_LWWWWLB_BB|"
                       . "LLLLWL_LWWWWL_BBB|"
                       . "LLLLWL_LWWWWL_BBB|"
                       . "LLLLWL___________",
                'result' => ".BBLLWLLWWWWLLBB.\n"
                          . "L.BLLWLLWWWWLLBB.\n"
                          . "L_.............._\n"
                          . "LL_BLLWLWWWWLLBB_\n"
                          . "LLL_LLWLWWWWLLBB_\n"
                          . "LLLL_LWLWWWWLLBB_\n"
                          . "LLLLW_LLWWWWLLBB_\n"
                          . "LLLLWL_LWWWWLLB_B\n"
                          . "LLLLWL_LWWWWLB_BB\n"
                          . "LLLLWL_LWWWWL_BBB\n"
                          . "LLLLWL_LWWWWL_BBB\n"
                          . "LLLLWL___________"
            ]
        ];
    }
}
