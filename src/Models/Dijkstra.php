<?php
declare(strict_types=1);

namespace App\Models;

use SplObjectStorage;
use App\Exceptions\PathInMazeNotFoundException;

class Dijkstra
{
    /**
     * @var callable
     */
    private $neighbors;

    /**
     * @var callable
     */
    private $length;

    /**
     * Dijkstra constructor.
     *
     * @param callable $neighbors
     * @param callable $length
     */
    public function __construct(callable $neighbors, callable $length)
    {
        $this->neighbors = $neighbors;
        $this->length = $length;
    }

    /**
     * see: https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm#Using_a_priority_queue
     *
     * @param object $src
     * @param object $dst
     * @return array
     * @throws PathInMazeNotFoundException
     */
    public function findPath(object $src, object $dst): array
    {
        // setup
        $queue = new MinQueue();
        $distance = new SplObjectStorage();
        $path = new SplObjectStorage();

        // init
        $queue->insert($src, 0);
        $distance[$src] = 0;

        while (count($queue) > 0) {
            $u = $queue->extract();

            if ($u === $dst) {
                return $this->buildPath($dst, $path);
            }

            foreach (call_user_func($this->neighbors, $u) as $v) {
                $alt = $distance[$u] + call_user_func($this->length, $u, $v);
                $best = $distance[$v] ?? INF;

                if ($alt < $best) {
                    $distance[$v] = $alt;
                    $path[$v] = $u;

                    if (!$queue->contains($v)) {
                        $queue->insert($v, $alt);
                    }
                }
            }
        }

        throw new PathInMazeNotFoundException;
    }

    /**
     * @param object            $dst
     * @param SplObjectStorage $path
     * @return array
     */
    private function buildPath(object $dst, SplObjectStorage $path): array
    {
        $result = [$dst];

        while (isset($path[$dst]) && null !== $path[$dst]) {
            $src = $path[$dst];
            $result[] = $src;
            $dst = $src;
        }

        return array_reverse($result);
    }
}
