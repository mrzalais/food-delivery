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
        $key = null;
        $line = null;
        foreach ($parsedMap as $x => $parsedMapLine) {
            $search = array_search(
                'user',
                array_column($parsedMapLine, 'type'),
                true
            );

            if (is_int($search)) {
                $key = $search;
                $line = $x;
                break;
            }
        }

        $element = $parsedMap[$line][$key];
        return ['x' => $element['x'], 'y' => $element['y']];
    }
}
