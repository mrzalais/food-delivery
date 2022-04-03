<?php

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

    public const TYPE_UNKNOWN = 'unknown';

    public array $parsed;

    public function __construct(array|string $map)
    {
        if (is_string($map)) {
            $parser = new MapParser;
            $this->parsed = $parser->parse($map);
        } else {
            $this->parsed = $map;
        }
    }

    public function insertObject(array $coordinates, string $type): void
    {
        $this->parsed[$coordinates['y']][$coordinates['x']]['type'] = $type;
    }
}
