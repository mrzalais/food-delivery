<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use App\Models\Maze;
use App\Models\Dijkstra;
use PHPUnit\Framework\TestCase;

class DijkstraTest extends TestCase
{
    public function testItCanFindEndingOfAMaze(): void
    {
        $maze = "CBBLLWLLWWWWLLBBR|
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
LLLLWL___________";

        $maze = Maze::fromString($maze);

        $start = $maze->find('C');
        $goal = $maze->find('R');

        $algo = new Dijkstra(    // return neighbors
            function ($a) use ($maze) {
                return $maze->getNeighbors($a, ['W', 'B', 'L']);
            },
            // calculate the distance
            function ($a, $b) use ($maze) {
                return $maze->getDistance($a, $b);
            }
            );

        $tStart = microtime(true);
        $path = $algo->findPath($start, $goal);
        $tEnd = microtime(true);

        // export the maze with the path marked with '.'
        $mazeStrWithPath = $maze->toString(function ($tile) use ($path) {
            return in_array($tile, $path, true) && !in_array($tile->value, ['S', 'T'])
                ? '.'
                : $tile->value
                ;
        });

        printf("%s\nin: %.5fs\n\n", $mazeStrWithPath, $tEnd - $tStart);

        $this->assertEquals('.BBLLWLLWWWWLLBB.|
L.BLLWLLWWWWLLBB.|
L.BBLLWLWWWWLLBB.|
LL.BLLWLWWWWLLBB.|
LLL.LLWLWWWWLLBB.|
LLLL.LWLWWWWLLBB.|
LLLLW.LLWWWWLLBB.|
LLLLWL.LWWWWLLB.B|
LLLLWL.LWWWWLB.BB|
LLLLWL.LWWWWL.BBB|
LLLLWL.LWWWWL.BBB|
LLLLWL_......____', $mazeStrWithPath);
    }

    public function testItPrioritisesShortestRoute(): void
    {
        $maze = "CBBLLWLLWWWWLLBBR|
L_BLLWLLWWWWLLBB_|
L________________|
LL_BLLWLWWWWLLBB_|
LLL_LLWLWWWWLLBB_|
LLLL_LWLWWWWLLBB_|
LLLLW_LLWWWWLLBB_|
LLLLWL_LWWWWLLB_B|
LLLLWL_LWWWWLB_BB|
LLLLWL_LWWWWL_BBB|
LLLLWL_LWWWWL_BBB|
LLLLWL___________";

        $maze = Maze::fromString($maze);

        $start = $maze->find('C');
        $goal = $maze->find('R');

        $algo = new Dijkstra(    // return neighbors
            function ($a) use ($maze) {
                return $maze->getNeighbors($a, ['W', 'B', 'L']);
            },
            // calculate the distance
            function ($a, $b) use ($maze) {
                return $maze->getDistance($a, $b);
            }
        );

        $tStart = microtime(true);
        $path = $algo->findPath($start, $goal);
        $tEnd = microtime(true);

        // export the maze with the path marked with '.'
        $mazeStrWithPath = $maze->toString(function ($tile) use ($path) {
            return in_array($tile, $path, true) && !in_array($tile->value, ['S', 'T'])
                ? '.'
                : $tile->value
                ;
        });

        printf("%s\nin: %.5fs\n\n", $mazeStrWithPath, $tEnd - $tStart);

        $this->assertEquals('.BBLLWLLWWWWLLBB.|
L.BLLWLLWWWWLLBB.|
L_.............._|
LL_BLLWLWWWWLLBB_|
LLL_LLWLWWWWLLBB_|
LLLL_LWLWWWWLLBB_|
LLLLW_LLWWWWLLBB_|
LLLLWL_LWWWWLLB_B|
LLLLWL_LWWWWLB_BB|
LLLLWL_LWWWWL_BBB|
LLLLWL_LWWWWL_BBB|
LLLLWL___________', $mazeStrWithPath);
    }
}
