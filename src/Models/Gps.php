<?php

namespace App\Models;

class Gps
{
    private string $map;
    private MapParser $mapParser;
    public Delivery $delivery;

    public function __construct(string $map, MapParser $mapParser)
    {
        $this->map = $map;
        $this->mapParser = $mapParser;
    }

    public function getLocationOfItem(string $type): array|false
    {
        $parsedMap = $this->mapParser->parse($this->map);
        $key = null;
        $line = null;
        foreach ($parsedMap as $x => $parsedMapLine) {
            $search = array_search(
                $type,
                array_column($parsedMapLine, 'type'),
                true
            );

            if (is_int($search)) {
                $key = $search;
                $line = $x;
                break;
            }
        }

        if (!is_int($key)) {
            return false;
        }

        $element = $parsedMap[$line][$key];
        return ['x' => $element['x'], 'y' => $element['y']];
    }

    public function initDelivery(Delivery $delivery): void
    {
        $this->delivery = $delivery;
    }
}
