<?php
declare(strict_types=1);

namespace App\Models;

class Map
{
    public const TYPE_BUILDING = 'building';
    public const TYPE_WATER = 'water';
    public const TYPE_LAND = 'land';
    public const TYPE_ROAD = 'road';
    public const TYPE_COURIER = 'courier';
    public const TYPE_ORDER = 'order';
    public const TYPE_RECIPIENT = 'recipient';

    public const TILE_TYPE_BUILDING = 'B';
    public const TILE_TYPE_WATER = 'W';
    public const TILE_TYPE_LAND = 'L';
    public const TILE_TYPE_ROAD = 'R';
    public const TILE_TYPE_COURIER = 'C';
    public const TILE_TYPE_ORDER = 'O';
    public const TILE_TYPE_RECIPIENT = 'R';

    public const TYPE_UNKNOWN = 'unknown';

    /**
     * @var array
     */
    public array $tiles;

    /**
     * Maze constructor.
     *
     * @param array|string $tiles
     */
    public function __construct(array|string $tiles)
    {
        if (is_string($tiles)) {
            $this->tiles = $this->fromString($tiles);
        } else {
            $this->tiles = $tiles;
        }
    }

    /**
     * @param string $maze
     * @param string $rowDelimiter
     * @return array
     */
    public function fromString(string $maze, string $rowDelimiter = "\n"): array
    {
        $tiles = [];

        foreach (explode($rowDelimiter, $maze) as $r => $row) {
            $rowTiles = [];
            foreach (str_split(trim($row)) as $c => $value) {
                $rowTiles[] = (object)[
                    'row' => $r,
                    'col' => $c,
                    'value' => $value
                ];
            }

            $tiles[] = $rowTiles;
        }

        return $tiles;
    }

    /**
     * @param callable|null $renderer
     * @param string        $rowDelimiter
     *
     * @return string
     */
    public function toString(callable $renderer = null, string $rowDelimiter = "\n"): string
    {
        $renderer = $renderer ?: function ($tile) { return $tile->value; };

        $result = [];
        foreach ($this->tiles as $r => $row) {
            if (!isset($result[$r])) {
                $result[$r] = [];
            }

            foreach ($row as $c => $tile) {
                $result[$r][$c] = $renderer($tile);
            }
        }

        return implode($rowDelimiter, array_map('implode', $result));
    }

    /**
     * @param string $value
     *
     * @return object
     */
    public function find(string $value)
    {
        foreach ($this->tiles as $row) {
            foreach ($row as $tile) {
                if ($tile->value === $value) {
                    return $tile;
                }
            }
        }

        return null;
    }

    /**
     * @param object $tile
     * @param array  $filter
     *
     * @return array
     */
    public function getNeighbors(object $tile, array $filter = []): array
    {
        $neighbors = [];
        foreach ([
            [-1, -1], [-1, 0], [-1, 1],
            [ 0, -1],          [ 0, 1],
            [ 1, -1], [ 1, 0], [ 1, 1],
        ] as $transformation) {
            $r = $tile->row + $transformation[0];
            $c = $tile->col + $transformation[1];

            if (isset($this->tiles[$r][$c]) && !in_array($this->tiles[$r][$c]->value, $filter, true)) {
                $neighbors[] = $this->tiles[$r][$c];
            }
        }

        return $neighbors;
    }

    /**
     * @param object $a
     * @param object $b
     *
     * @return float
     */
    public function getDistance(object $a, object $b): float
    {
        $p = $b->row - $a->row;
        $q = $b->col - $a->col;

        return sqrt($p * $p + $q * $q);
    }

    public function insertObject(array $coordinates, string $type): void
    {
        $this->tiles[$coordinates['y']][$coordinates['x']]->value = $type;
    }
}
