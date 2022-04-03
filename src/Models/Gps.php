<?php

namespace App\Models;

class Gps
{
    private Map $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function getLocationOfItemByCoordinates(array $coordinates): array|false
    {
        return $this->map->parsed[$coordinates['y']][$coordinates['x']];
    }

    public function getLocationOfItemByType(string $type): array|false
    {
        $key = null;
        $line = null;
        foreach ($this->map->parsed as $x => $parsedMapLine) {
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

        $element = $this->map->parsed[$line][$key];
        return ['x' => $element['x'], 'y' => $element['y']];
    }
}
