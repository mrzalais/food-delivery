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
    public string $string;

    public function __construct(string $map)
    {
        $parser = new MapParser;
        $this->string = $map;
        $this->parsed = $parser->parse($map);
    }

    public function insertObject(array $coordinates, string $type): void
    {
        $this->parsed[$coordinates['y']][$coordinates['x']]['type'] = $type;
    }
}
