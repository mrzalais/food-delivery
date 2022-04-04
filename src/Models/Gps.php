<?php

namespace App\Models;

class Gps
{
    private Map $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    // public function getLocationOfItemByCoordinates(array $coordinates): array|false
    // {
    //     return $this->map->tiles[$coordinates['y']][$coordinates['x']];
    // }

    public function getLocationOfItemByType(string $value)
    {
        foreach ($this->map->tiles as $row) {
            foreach ($row as $tile) {
                if ($tile->value === $value) {
                    return $tile;
                }
            }
        }

        return null;
    }

    public function getMapString(): string
    {
        return $this->map->string;
    }

    /**
     * @param string $value
     *
     * @return object
     */
    public function find(string $value)
    {
        foreach ($this->map->tiles as $row) {
            foreach ($row as $tile) {
                if ($tile->value === $value) {
                    return $tile;
                }
            }
        }

        return null;
    }
}
