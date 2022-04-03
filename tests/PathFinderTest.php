<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Maze;
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
        $maze = Maze::fromString($map);

        $pathFinder = new PathFinder(
            $maze->find('C'),
            $maze->find('R'),
            $maze
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
                'result' => ".BBLLWLLWWWWLLBB.|"
                          . "L.BLLWLLWWWWLLBB.|"
                          . "L.BBLLWLWWWWLLBB.|"
                          . "LL.BLLWLWWWWLLBB.|"
                          . "LLL.LLWLWWWWLLBB.|"
                          . "LLLL.LWLWWWWLLBB.|"
                          . "LLLLW.LLWWWWLLBB.|"
                          . "LLLLWL.LWWWWLLB.B|"
                          . "LLLLWL.LWWWWLB.BB|"
                          . "LLLLWL.LWWWWL.BBB|"
                          . "LLLLWL.LWWWWL.BBB|"
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
                'result' => ".BBLLWLLWWWWLLBB.|"
                          . "L.BLLWLLWWWWLLBB.|"
                          . "L_.............._|"
                          . "LL_BLLWLWWWWLLBB_|"
                          . "LLL_LLWLWWWWLLBB_|"
                          . "LLLL_LWLWWWWLLBB_|"
                          . "LLLLW_LLWWWWLLBB_|"
                          . "LLLLWL_LWWWWLLB_B|"
                          . "LLLLWL_LWWWWLB_BB|"
                          . "LLLLWL_LWWWWL_BBB|"
                          . "LLLLWL_LWWWWL_BBB|"
                          . "LLLLWL___________"
            ]
        ];
    }
}
