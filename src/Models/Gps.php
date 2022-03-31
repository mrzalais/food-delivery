<?php

namespace App\Models;

class Gps
{
    private string $map;
    private MapParser $mapParser;

    public function __construct(string $map, MapParser $mapParser)
    {
        $this->map = $map;
        $this->mapParser = $mapParser;
    }

    public function getCurrentLocation(): array
    {
        $parsedMap = $this->mapParser->parse($this->map);
        $key = array_search(
            'user',
            array_column($parsedMap, 'type'),
            true
        );
        $element = $parsedMap[$key];
        return ['x' => $element['x'], 'y' => $element['y']];
    }
}
