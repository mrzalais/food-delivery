<?php

namespace App\Models;

class PathFinder
{
    private object $start;
    private object   $goal;
    private Map      $maze;
    private Dijkstra $dijkstra;
    public string $stringWithPath = '';

    public function __construct(object $start, object $goal, Map $maze)
    {
        $this->start = $start;
        $this->goal = $goal;
        $this->maze = $maze;

        $this->initDijkstra();

        $this->getPath(true);
    }

    public function initDijkstra(): void
    {
        $this->dijkstra = new Dijkstra(// return neighbors
            function ($a) {
                return $this->maze->getNeighbors($a, ['W', 'B', 'L']);
            },
            // calculate the distance
            function ($a, $b) {
                return $this->maze->getDistance($a, $b);
            }
        );
    }

    public function getPath(bool $asString = false): array|string
    {
        $path = $this->dijkstra->findPath($this->start, $this->goal);

        if ($asString) {
            // export the maze with the path marked with '.'
            $this->stringWithPath = $this->maze->toString(function ($tile) use ($path) {
                if (in_array($tile, $path, true) && !in_array($tile->value, ['S', 'T'])) {
                    return '.';
                }

                return $tile->value;
            });
            return $this->stringWithPath;
        }

        return $path;
    }

    public function getHumanReadableResult(): string
    {
        return sprintf(
            "%s\nin: %.5fs\n\n",
            $this->stringWithPath,
            $this->dijkstra->startTime - $this->dijkstra->finishTime
        );
    }
}
